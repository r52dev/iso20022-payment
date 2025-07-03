<?php

namespace R52dev\ISO20022\Tests;

use R52dev\ISO20022\UnstructuredPostalAddress;

/**
 * @coversDefaultClass \R52dev\ISO20022\UnstructuredPostalAddress
 */
class UnstructuredPostalAddressTest extends TestCase
{
    /**
     * @covers ::sanitize
     */
    public function testSanitize()
    {
        $this->assertInstanceOf('R52dev\ISO20022\UnstructuredPostalAddress', UnstructuredPostalAddress::sanitize(
            "Dorf—Strasse 3\n\n",
            "8000\tZürich"
        ));
    }
}
