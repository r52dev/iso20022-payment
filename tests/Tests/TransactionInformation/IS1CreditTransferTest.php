<?php

namespace R52dev\ISO20022\Tests\TransactionInformation;

use R52dev\ISO20022\Money;
use R52dev\ISO20022\PostalAccount;
use R52dev\ISO20022\StructuredPostalAddress;
use R52dev\ISO20022\Tests\TestCase;
use R52dev\ISO20022\TransactionInformation\IS1CreditTransfer;

/**
 * @coversDefaultClass \R52dev\ISO20022\TransactionInformation\IS1CreditTransfer
 */
class IS1CreditTransferTest extends TestCase
{
    /**
     * @covers ::__construct
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidAmount()
    {
        $transfer = new IS1CreditTransfer(
            'id000',
            'name',
            new Money\USD(100),
            'name',
            new StructuredPostalAddress('foo', '99', '9999', 'bar'),
            new PostalAccount('10-2424-4')
        );
    }
}
