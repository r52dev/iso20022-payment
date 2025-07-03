<?php

namespace R52dev\ISO20022\Tests;

use DOMDocument;
use DOMXPath;
use R52dev\ISO20022\IBAN;
use R52dev\ISO20022\IID;

/**
 * @coversDefaultClass \R52dev\ISO20022\IID
 */
class IIDTest extends TestCase
{
    /**
     * @dataProvider validSamples
     * @covers ::__construct
     */
    public function testValid($iid)
    {
        $this->assertInstanceOf('R52dev\ISO20022\IID', new IID($iid));
    }

    public function validSamples()
    {
        return [
            ['9222'],
            ['00432'],
        ];
    }

    /**
     * @dataProvider invalidSamples
     * @covers ::__construct
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidLength($iid)
    {
        new IID($iid);
    }

    public function invalidSamples()
    {
        return [
            ['00000000'],
            ['10000000'],
            ['11'],
            ['FFF'],
            ['0 11'],
        ];
    }

    /**
     * @covers ::format
     */
    public function testFormat()
    {
        $instance = new IID('350');
        $this->assertSame('00350', $instance->format());
    }

    /**
     * @covers ::fromIBAN
     */
    public function testFromIBAN()
    {
        $instance = IID::fromIBAN(new IBAN('CH31 8123 9000 0012 4568 9'));
        $this->assertSame('81239', $instance->format());
    }

    /**
     * @cover ::fromIban
     * @expectedException \InvalidArgumentException
     */
    public function testFromIBANForeign()
    {
        IID::fromIBAN(new IBAN('GB29 NWBK 6016 1331 9268 19'));
    }

    /**
     * @cover ::asDom
     */
    public function testAsDom()
    {
        $doc = new DOMDocument();
        $iid = new IID('09000');

        $xml = $iid->asDom($doc);

        $xpath = new DOMXPath($doc);
        $this->assertSame('9000', $xpath->evaluate('string(.//MmbId)', $xml));
    }
}
