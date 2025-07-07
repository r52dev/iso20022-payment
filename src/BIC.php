<?php

namespace R52dev\ISO20022;

use InvalidArgumentException;

/**
 * BIC
 */
class BIC implements FinancialInstitutionInterface
{
    const PATTERN = '/^[A-Z]{6}[A-Z2-9][A-NP-Z0-9]([A-Z0-9]{3})?$/';
    const COUNTRY_PATTERN = '/^[A-Z]{2}$/';

    /**
     * @var string
     */
    protected $bic;

    /**
     * @var string|null
     */
    protected $country;

    /**
     * Constructor
     *
     * @param string $bic
     * @param string|bool|null $country
     */
    public function __construct(string $bic, $country = null)
    {
        $bic = strtoupper($bic);

        if (!preg_match(self::PATTERN, $bic)) {
            throw new InvalidArgumentException('BIC is not properly formatted.');
        }

        if ($country === true) {
            $extracted = substr($bic, 4, 2);
            if (!preg_match(self::COUNTRY_PATTERN, $extracted)) {
                throw new InvalidArgumentException("Extracted country code '{$extracted}' from BIC is invalid.");
            }
            $this->country = $extracted;
        } elseif (is_string($country)) {
            $upperCountry = strtoupper($country);
            if (!preg_match(self::COUNTRY_PATTERN, $upperCountry)) {
                throw new InvalidArgumentException("Provided country code '{$country}' is not valid (must be two uppercase letters).");
            }
            $this->country = $upperCountry;
        } elseif ($country !== null) {
            throw new InvalidArgumentException('Country must be a string, true, or null.');
        }

        $this->bic = $bic;
    }

    public function format(): string
    {
        return $this->bic;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * {@inheritdoc}
     */
    public function asDom(\DOMDocument $doc)
    {
        $xml = $doc->createElement('FinInstnId');
        $xml->appendChild($doc->createElement('BIC', $this->format()));

        if ($this->country) {
            $pstlAdr = $doc->createElement('PstlAdr');
            $pstlAdr->appendChild($doc->createElement('Ctry', $this->country));
            $xml->appendChild($pstlAdr);
        }

        return $xml;
    }
}
