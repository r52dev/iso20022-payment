<?php

namespace R52dev\ISO20022;

/**
 * General interface for financial institutions
 */
interface FinancialInstitutionInterface
{
    /**
     * Returns a XML representation to identify the financial institution
     *
     * @param \DOMDocument $doc
     *
     * @return \DOMElement The built DOM element
     */
    public function asDom(\DOMDocument $doc);
}
