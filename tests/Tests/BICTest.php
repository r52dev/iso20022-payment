<?php

namespace R52dev\ISO20022\Tests;

use R52dev\ISO20022\BIC;

class BICTest extends TestCase
{
    /**
     * @dataProvider validSamples
     * @covers \R52dev\ISO20022\BIC::__construct
     */
    public function testValid($bic)
    {
        $this->check($bic, true);
    }

    /**
     * @covers \R52dev\ISO20022\BIC::__construct
     */
    public function testInvalidLength()
    {
        $this->check('AABAFI22F', false);
        $this->check('HANDFIHH00', false);
    }

    /**
     * @covers \R52dev\ISO20022\BIC::__construct
     */
    public function testInvalidChars()
    {
        $this->check('HAND-FIHH', false);
        $this->check('HAND FIHH', false);
    }

    /**
     * @dataProvider validSamples
     * @covers \R52dev\ISO20022\BIC::format
     */
    public function testFormat($bic)
    {
        $instance = new BIC($bic);
        $this->assertEquals($bic, $instance->format());
    }

    public function validSamples()
    {
        return [
            ['AABAFI22'],
            ['HANDFIHH'],
            ['DEUTDEFF500'],
        ];
    }

    protected function check($iban, $valid)
    {
        $exception = false;
        try {
            $temp = new BIC($iban);
        } catch (\InvalidArgumentException $e) {
            $exception = true;
        }
        $this->assertTrue($exception != $valid);
    }
}
