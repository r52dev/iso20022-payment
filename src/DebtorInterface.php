<?php

namespace R52dev\ISO20022;

/**
 * General interface for debtor entities
 */
interface DebtorInterface
{
    /**
     * Returns an XML representation of the debtor
     *
     * This corresponds to the <Dbtr> element in ISO 20022 messages.
     *
     * @param \DOMDocument $doc
     * @return \DOMElement The built DOM element
     */
    public function asDom(\DOMDocument $doc): \DOMElement;
}
