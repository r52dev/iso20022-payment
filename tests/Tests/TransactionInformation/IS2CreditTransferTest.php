<?php

namespace R52dev\ISO20022\Tests\TransactionInformation;

use R52dev\ISO20022\IBAN;
use R52dev\ISO20022\Money;
use R52dev\ISO20022\PostalAccount;
use R52dev\ISO20022\StructuredPostalAddress;
use R52dev\ISO20022\Tests\TestCase;
use R52dev\ISO20022\TransactionInformation\IS2CreditTransfer;

/**
 * @coversDefaultClass \R52dev\ISO20022\TransactionInformation\IS2CreditTransfer
 */
class IS2CreditTransferTest extends TestCase
{
    /**
     * @covers ::__construct
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidAmount()
    {
        $transfer = new IS2CreditTransfer(
            'id000',
            'name',
            new Money\USD(100),
            'creditor name',
            new StructuredPostalAddress('foo', '99', '9999', 'bar'),
            new Iban('AZ21 NABZ 0000 0000 1370 1000 1944'),
            'name',
            new PostalAccount('10-2424-4')
        );
    }
}
