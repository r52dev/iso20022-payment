<?php

namespace R52dev\ISO20022;

/**
 * PostalAddressInterface
 */
interface PostalAddressInterface
{
    /**
     * Returns a XML representation of the address
     *
     * @param \DOMDocument $doc
     *
     * @return \DOMElement The built DOM element
     */
    public function asDom(\DOMDocument $doc);
}
