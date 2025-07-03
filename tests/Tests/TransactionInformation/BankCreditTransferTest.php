<?php

namespace R52dev\ISO20022\Tests\TransactionInformation;

use R52dev\ISO20022\BIC;
use R52dev\ISO20022\IBAN;
use R52dev\ISO20022\BBAN;
use R52dev\ISO20022\Money;
use R52dev\ISO20022\StructuredPostalAddress;
use R52dev\ISO20022\Tests\TestCase;
use R52dev\ISO20022\TransactionInformation\BankCreditTransfer;

/**
 * @coversDefaultClass \R52dev\ISO20022\TransactionInformation\BankCreditTransfer
 */
class BankCreditTransferTest extends TestCase
{
    /**
     * @covers ::__construct
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidCreditorAgent()
    {
        $creditorAgent = $this->getMock('\R52dev\ISO20022\FinancialInstitutionInterface');

        $transfer = new BankCreditTransfer(
            'id000',
            'name',
            new Money\CHF(100),
            'name',
            new StructuredPostalAddress('foo', '99', '9999', 'bar'),
            new IBAN('CH31 8123 9000 0012 4568 9'),
            $creditorAgent
        );
    }

    /**
     * @covers ::__construct
     * @expectedException \TypeError
     */
    public function testInvalidAmount()
    {
        $transfer = new BankCreditTransfer(
            'id000',
            'name',
            100,
            'name',
            new StructuredPostalAddress('foo', '99', '9999', 'bar'),
            new IBAN('CH31 8123 9000 0012 4568 9'),
            new BIC('PSETPD2SZZZ')
        );
    }

    /**
     * @covers ::__construct
     */
    public function testBankCreditCanBeDoneWithSEKAndBBAN()
    {
        $transfer = new BankCreditTransfer(
            'id000',
            'name',
            new Money\SEK(100),
            'name',
            new StructuredPostalAddress('foo', '99', '9999', 'bar'),
            new BBAN('1234', '123456789'),
            new BIC('PSETPD2SZZZ')
        );
    }
}
