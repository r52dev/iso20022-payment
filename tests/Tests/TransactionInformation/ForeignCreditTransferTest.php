<?php

namespace R52dev\ISO20022\Tests\TransactionInformation;

use R52dev\ISO20022\IBAN;
use R52dev\ISO20022\Money;
use R52dev\ISO20022\StructuredPostalAddress;
use R52dev\ISO20022\Tests\TestCase;
use R52dev\ISO20022\TransactionInformation\ForeignCreditTransfer;

/**
 * @coversDefaultClass \R52dev\ISO20022\TransactionInformation\ForeignCreditTransfer
 */
class ForeignCreditTransferTest extends TestCase
{
    /**
     * @covers ::__construct
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidCreditorAgent()
    {
        $creditorAgent = $this->getMock('\R52dev\ISO20022\FinancialInstitutionInterface');

        $transfer = new ForeignCreditTransfer(
            'id000',
            'name',
            new Money\CHF(100),
            'name',
            new StructuredPostalAddress('foo', '99', '9999', 'bar'),
            new IBAN('CH31 8123 9000 0012 4568 9'),
            $creditorAgent
        );
    }
}
