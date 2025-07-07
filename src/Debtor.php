<?php
namespace R52dev\ISO20022;

use DOMDocument;
use R52dev\ISO20022\DebtorInterface;

class Debtor implements DebtorInterface
{
    protected string $name;
    protected ?string $country = null;
    protected ?string $orgId = null;
    protected ?string $schemeCode = null;

    public function __construct(string $name)
    {
        $this->name = Text::assert($name, 70);
    }

    public function setCountry(string $country): static
    {
        $this->country = strtoupper($country);
        return $this;
    }

    public function setOrgId(string $orgId, string $schemeCode = 'BANK'): static
    {
        $this->orgId = $orgId;
        $this->schemeCode = $schemeCode;
        return $this;
    }

    public function asDom(DOMDocument $doc): \DOMElement
    {
        $dbtr = $doc->createElement('Dbtr');
        $dbtr->appendChild(Text::xml($doc, 'Nm', $this->name));

        if ($this->country) {
            $adr = $doc->createElement('PstlAdr');
            $adr->appendChild(Text::xml($doc, 'Ctry', $this->country));
            $dbtr->appendChild($adr);
        }

        if ($this->orgId) {
            $id = $doc->createElement('Id');
            $orgId = $doc->createElement('OrgId');
            $othr = $doc->createElement('Othr');

            $othr->appendChild(Text::xml($doc, 'Id', $this->orgId));

            $scheme = $doc->createElement('SchmeNm');
            $scheme->appendChild(Text::xml($doc, 'Cd', $this->schemeCode ?? 'BANK'));

            $othr->appendChild($scheme);
            $orgId->appendChild($othr);
            $id->appendChild($orgId);

            $dbtr->appendChild($id);
        }

        return $dbtr;
    }
}
