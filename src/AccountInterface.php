<?php

namespace R52dev\ISO20022;

use DOMDocument;
use DOMElement;

/**
 * General interface for accounts
 */
interface AccountInterface
{
    /**
     * Format the account in a human-readable manner
     *
     * @return string The formatted account
     */
    public function format();

    /**
     * Returns a XML representation to identify the account
     *
     * @param DOMDocument $doc
     *
     * @return DOMElement The built DOM element
     */
    public function asDom(DOMDocument $doc);
}
