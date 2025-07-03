<?php

namespace R52dev\ISO20022\Tests\Money;

use R52dev\ISO20022\Money;
use R52dev\ISO20022\Tests\TestCase;

class MixedTypeTest extends TestCase
{
    /**
     * @covers \R52dev\ISO20022\Money\MixedType::plus
     */
    public function testPlus()
    {
        $sum = new Money\MixedType(0);
        $sum = $sum->plus(new Money\CHF(2456));
        $sum = $sum->plus(new Money\CHF(1000));
        $sum = $sum->plus(new Money\JPY(1200));

        $this->assertEquals('1234.56', $sum->format());
    }

    /**
     * @covers \R52dev\ISO20022\Money\MixedType::minus
     */
    public function testMinus()
    {
        $sum = new Money\MixedType(100);
        $sum = $sum->minus(new Money\CHF(5000));
        $sum = $sum->minus(new Money\CHF(99));
        $sum = $sum->minus(new Money\JPY(300));

        $this->assertEquals('-250.99', $sum->format());
    }
}
