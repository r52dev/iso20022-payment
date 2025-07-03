<?php

namespace R52dev\ISO20022\Tests\Message;

use R52dev\ISO20022\BIC;
use R52dev\ISO20022\FinancialInstitutionAddress;
use R52dev\ISO20022\GeneralAccount;
use R52dev\ISO20022\IBAN;
use R52dev\ISO20022\IID;
use R52dev\ISO20022\ISRParticipant;
use R52dev\ISO20022\Message\CustomerCreditTransfer;
use R52dev\ISO20022\Money;
use R52dev\ISO20022\PaymentInformation\CategoryPurposeCode;
use R52dev\ISO20022\PaymentInformation\PaymentInformation;
use R52dev\ISO20022\PaymentInformation\SEPAPaymentInformation;
use R52dev\ISO20022\PostalAccount;
use R52dev\ISO20022\StructuredPostalAddress;
use R52dev\ISO20022\Tests\TestCase;
use R52dev\ISO20022\TransactionInformation\BankCreditTransfer;
use R52dev\ISO20022\TransactionInformation\ForeignCreditTransfer;
use R52dev\ISO20022\TransactionInformation\IS1CreditTransfer;
use R52dev\ISO20022\TransactionInformation\IS2CreditTransfer;
use R52dev\ISO20022\TransactionInformation\ISRCreditTransfer;
use R52dev\ISO20022\TransactionInformation\PurposeCode;
use R52dev\ISO20022\TransactionInformation\SEPACreditTransfer;
use R52dev\ISO20022\UnstructuredPostalAddress;

class CustomerCreditTransferTest extends TestCase
{
    const SCHEMA = 'urn:iso:std:iso:20022:tech:xsd:pain.001.001.03';
    const SCHEMA_PATH = 'pain.001.001.03.xsd';

    protected function buildMessage()
    {
        $message = new CustomerCreditTransfer('message-000', 'InnoMuster AG');

        $payment = new PaymentInformation(
            'payment-000',
            'InnoMuster AG',
            new BIC('ZKBKCHZZ80A'),
            new IBAN('CH6600700110000204481')
        );
        $message->addPayment($payment);

        $transaction = new BankCreditTransfer(
            'instr-000',
            'e2e-000',
            new Money\CHF(130000), // CHF 1300.00
            'Muster Transport AG',
            new StructuredPostalAddress('Wiesenweg', '14b', '8058', 'Zürich-Flughafen'),
            new IBAN('CH51 0022 5225 9529 1301 C'),
            new BIC('UBSWCHZH80A')
        );
        $payment->addTransaction($transaction);

        $transaction = new IS1CreditTransfer(
            'instr-001',
            'e2e-001',
            new Money\CHF(30000), // CHF 300.00
            'Finanzverwaltung Stadt Musterhausen',
            new StructuredPostalAddress('Altstadt', '1a', '4998', 'Muserhausen'),
            new PostalAccount('80-5928-4')
        );
        $payment->addTransaction($transaction);

        $transaction = new IS2CreditTransfer(
            'instr-002',
            'e2e-002',
            new Money\CHF(20000), // CHF 200.00
            'Druckerei Muster GmbH',
            new StructuredPostalAddress('Gartenstrasse', '61', '3000', 'Bern'),
            new IBAN('CH03 0900 0000 3054 1118 8'),
            'Musterbank AG',
            new PostalAccount('80-151-4')
        );
        $payment->addTransaction($transaction);

        $iban = new IBAN('CH51 0022 5225 9529 1301 C');
        $transaction = new BankCreditTransfer(
            'instr-003',
            'e2e-003',
            new Money\CHF(30000), // CHF 300.00
            'Muster Transport AG',
            null,
            $iban,
            IID::fromIBAN($iban)
        );
        $transaction->setPurpose(new PurposeCode('AIRB'));
        $payment->addTransaction($transaction);

        $payment = new PaymentInformation(
            'payment-010',
            'InnoMuster AG',
            new BIC('POFICHBEXXX'),
            new IBAN('CH6309000000250097798')
        );
        $message->addPayment($payment);

        $transaction = new SEPACreditTransfer(
            'instr-010',
            'e2e-010',
            new Money\EUR(70000), // EUR 700.00
            'Muster Immo AG',
            new UnstructuredPostalAddress('Musterstraße 35', '80333 München', 'DE'),
            new IBAN('DE89 3704 0044 0532 0130 00'),
            new BIC('COBADEFFXXX')
        );
        $payment->addTransaction($transaction);

        $transaction = new ForeignCreditTransfer(
            'instr-011',
            'e2e-011',
            new Money\GBP(6500), // GBP 65.00
            'United Development Ltd',
            new UnstructuredPostalAddress('George Street', 'BA1 2FJ Bath', 'GB'),
            new IBAN('GB29 NWBK 6016 1331 9268 19'),
            new BIC('NWBKGB2L')
        );
        $payment->addTransaction($transaction);

        $transaction = new ForeignCreditTransfer(
            'instr-012',
            'e2e-012',
            new Money\KWD(300001), // KWD 300.001
            'United Development Kuwait',
            new UnstructuredPostalAddress('P.O. Box 23954 Safat', '13100 Kuwait', 'KW'),
            new IBAN('BR97 0036 0305 0000 1000 9795 493P 1'),
            new FinancialInstitutionAddress('Caixa Economica Federal', new UnstructuredPostalAddress('Rua Sao Valentim, 620', '03446-040 Sao Paulo-SP', 'BR'))
        );
        $payment->addTransaction($transaction);

        $transaction = new ForeignCreditTransfer(
            'instr-013',
            'e2e-013',
            new Money\GBP(4500), // GBP 45.00
            'United Development Belgium SA/NV',
            new UnstructuredPostalAddress('Oostjachtpark 187', '6743 Buzenol', 'BE'),
            new GeneralAccount('123-4567890-78'),
            new FinancialInstitutionAddress('Belfius Bank', new UnstructuredPostalAddress('Pachecolaan 44', '1000 Brussel', 'BE'))
        );
        $transaction->setIntermediaryAgent(new BIC('SWHQBEBB'));
        $payment->addTransaction($transaction);

        $payment = new SEPAPaymentInformation(
            'payment-020',
            'InnoMuster AG',
            new BIC('POFICHBEXXX'),
            new IBAN('CH6309000000250097798')
        );
        $message->addPayment($payment);

        $transaction = new SEPACreditTransfer(
            'instr-020',
            'e2e-020',
            new Money\EUR(10000), // EUR 100.00
            'Bau Muster AG',
            new UnstructuredPostalAddress('Musterallee 11', '10115 Berlin', 'DE'),
            new IBAN('DE22 2665 0001 9311 6826 12'),
            new BIC('NOLADE21EMS')
        );
        $payment->addTransaction($transaction);

        $payment = new PaymentInformation(
            'payment-030',
            'InnoMuster AG',
            new BIC('POFICHBEXXX'),
            new IBAN('CH6309000000250097798')
        );
        $message->addPayment($payment);

        $transaction = new ISRCreditTransfer(
            'instr-030',
            'e2e-030',
            new Money\CHF(20000), // CHF 200.00
            new ISRParticipant('01-1439-8'),
            '210000000003139471430009017'
        );
        $payment->addTransaction($transaction);

        $transaction = new ISRCreditTransfer(
            'instr-031',
            'e2e-031',
            new Money\CHF(20000), // CHF 200.00
            new ISRParticipant('01-95106-8'),
            '6019701803969733825'
        );
        $transaction->setCreditorDetails(
            'Fritz Bischof',
            new StructuredPostalAddress('Dorfstrasse', '17', '9911', 'Musterwald')
        );
        $payment->addTransaction($transaction);

        $payment = new PaymentInformation(
            'payment-040',
            'InnoMuster AG',
            new BIC('POFICHBEXXX'),
            new IBAN('CH6309000000250097798')
        );
        $payment->setCategoryPurpose(new CategoryPurposeCode('SALA'));
        $message->addPayment($payment);

        $transaction = new IS1CreditTransfer(
            'instr-040',
            'e2e-040',
            new Money\CHF(50000), // CHF 500.00
            'Meier & Söhne AG',
            new StructuredPostalAddress('Dorfstrasse', '17', '9911', 'Musterwald'),
            new PostalAccount('60-9-9')
        );
        $payment->addTransaction($transaction);

        return $message;
    }

    public function testGroupHeader()
    {
        $xml = $this->buildMessage()->asXml();

        $doc = new \DOMDocument();
        $doc->loadXML($xml);
        $xpath = new \DOMXPath($doc);
        $xpath->registerNamespace('pain001', self::SCHEMA);

        $nbOfTxs = $xpath->evaluate('string(//pain001:GrpHdr/pain001:NbOfTxs)');
        $this->assertEquals('12', $nbOfTxs);

        $ctrlSum = $xpath->evaluate('string(//pain001:GrpHdr/pain001:CtrlSum)');
        $this->assertEquals('4210.001', $ctrlSum);
    }

    public function testSchemaValidation()
    {
        $xml = $this->buildMessage()->asXml();
        $schemaPath = __DIR__.'/../../../../'.self::SCHEMA_PATH;

        $doc = new \DOMDocument();
        $doc->loadXML($xml);

        libxml_use_internal_errors(true);
        $valid = $doc->schemaValidate($schemaPath);
        foreach (libxml_get_errors() as $error) {
            $this->fail($error->message);
        }
        $this->assertTrue($valid);
        libxml_clear_errors();
        libxml_use_internal_errors(false);
    }

    public function testGetPaymentCount()
    {
        $message = $this->buildMessage();

        $this->assertSame(5, $message->getPaymentCount());
    }
}
