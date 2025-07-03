<?php

namespace R52dev\ISO20022\Tests;

use R52dev\ISO20022\StructuredPostalAddress;

/**
 * @coversDefaultClass \R52dev\ISO20022\StructuredPostalAddress
 */
class StructuredPostalAddressTest extends TestCase
{
    /**
     * @covers ::sanitize
     */
    public function testSanitize()
    {
        $this->assertInstanceOf('R52dev\ISO20022\StructuredPostalAddress', StructuredPostalAddress::sanitize(
            'Dorfstrasse',
            '∅',
            'Pfaffenschlag bei Waidhofen an der Thaya',
            '3834',
            'AT'
        ));
    }
}
