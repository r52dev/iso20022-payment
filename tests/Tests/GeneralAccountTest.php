<?php

namespace R52dev\ISO20022\Tests;

use InvalidArgumentException;
use R52dev\ISO20022\GeneralAccount;

class GeneralAccountTest extends TestCase
{
    /**
     * @covers \R52dev\ISO20022\GeneralAccount::__construct
     */
    public function testValid()
    {
        $instance = new GeneralAccount('A-123-4567890-78');
    }

    /**
     * @covers \R52dev\ISO20022\GeneralAccount::__construct
     * @expectedException InvalidArgumentException
     */
    public function testInvalid()
    {
        $instance = new GeneralAccount('0123456789012345678901234567890123456789');
    }

    /**
     * @covers \R52dev\ISO20022\GeneralAccount::format
     */
    public function testFormat()
    {
        $instance = new GeneralAccount('  123-4567890-78 AA ');
        $this->assertSame('  123-4567890-78 AA ', $instance->format());
    }
}
