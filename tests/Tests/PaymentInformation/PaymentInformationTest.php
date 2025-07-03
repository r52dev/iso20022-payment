<?php

namespace R52dev\ISO20022\Tests\PaymentInformation;

use DOMDocument;
use DOMXPath;
use R52dev\ISO20022\BIC;
use R52dev\ISO20022\IBAN;
use R52dev\ISO20022\Money;
use R52dev\ISO20022\PaymentInformation\CategoryPurposeCode;
use R52dev\ISO20022\PaymentInformation\PaymentInformation;
use R52dev\ISO20022\PostalAccount;
use R52dev\ISO20022\StructuredPostalAddress;
use R52dev\ISO20022\Tests\TestCase;
use R52dev\ISO20022\TransactionInformation\IS1CreditTransfer;

/**
 * @coversDefaultClass \R52dev\ISO20022\PaymentInformation\PaymentInformation
 */
class PaymentInformationTest extends TestCase
{
    /**
     * @covers ::__construct
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidDebtorAgent()
    {
        $debtorAgent = $this->getMock('\R52dev\ISO20022\FinancialInstitutionInterface');

        $payment = new PaymentInformation(
            'id000',
            'name',
            $debtorAgent,
            new IBAN('CH31 8123 9000 0012 4568 9')
        );
    }

    /**
     * @covers ::hasPaymentTypeInformation
     */
    public function testHasPaymentTypeInformation()
    {
        $payment = new PaymentInformation(
            'id000',
            'name',
            new BIC('POFICHBEXXX'),
            new IBAN('CH31 8123 9000 0012 4568 9')
        );

        $this->assertFalse($payment->hasPaymentTypeInformation());
    }

    /**
     * @covers ::asDom
     */
    public function testInfersPaymentInformation()
    {
        $doc = new DOMDocument();
        $payment = new PaymentInformation(
            'id000',
            'name',
            new BIC('POFICHBEXXX'),
            new IBAN('CH31 8123 9000 0012 4568 9')
        );
        $payment->setCategoryPurpose(new CategoryPurposeCode('SALA'));
        $payment->addTransaction(new IS1CreditTransfer(
            'instr-001',
            'e2e-001',
            new Money\CHF(10000), // CHF 100.00
            'Fritz Bischof',
            new StructuredPostalAddress('Dorfstrasse', '17', '9911', 'Musterwald'),
            new PostalAccount('60-9-9')
        ));
        $payment->addTransaction(new IS1CreditTransfer(
            'instr-002',
            'e2e-002',
            new Money\CHF(30000), // CHF 300.00
            'Franziska Meier',
            new StructuredPostalAddress('Altstadt', '1a', '4998', 'Muserhausen'),
            new PostalAccount('80-151-4')
        ));

        $xml = $payment->asDom($doc);

        $xpath = new DOMXPath($doc);
        $this->assertNull($payment->getServiceLevel());
        $this->assertNull($payment->getLocalInstrument());
        $this->assertSame('CH02', $xpath->evaluate('string(./PmtTpInf/LclInstrm/Prtry)', $xml));
        $this->assertSame(0.0, $xpath->evaluate('count(./CdtTrfTxInf/PmtTpInf/LclInstrm/Prtry)', $xml));
    }
}
