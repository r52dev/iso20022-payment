<?php

namespace R52dev\ISO20022\TransactionInformation;

use DOMDocument;
use InvalidArgumentException;
use R52dev\ISO20022\AccountInterface;
use R52dev\ISO20022\BIC;
use R52dev\ISO20022\BBAN;
use R52dev\ISO20022\IID;
use R52dev\ISO20022\Money;
use R52dev\ISO20022\PaymentInformation\PaymentInformation;
use R52dev\ISO20022\FinancialInstitutionInterface;

class DomesticBankCreditTransfer extends CreditTransfer
{

    /**
     * @var BBAN
     */
    protected $creditorAccount;

    /**
     * @var FinancialInstitutionInterface|null
     */
    protected $creditorAgent;

    /**
     * {@inheritdoc}
     *
     * @param BBAN    $creditorAccount BBAN of the creditor
     * @param BIC|IID $creditorAgent Optional BIC or IID of the creditor's financial institution
     *
     * @throws \InvalidArgumentException When the amount is not in EUR or CHF or when the creditor agent is not BIC or IID.
     */
    public function __construct($instructionId, $endToEndId, Money\Money $amount, $creditorName, $creditorAddress, AccountInterface $creditorAccount, FinancialInstitutionInterface $creditorAgent = null)
    {
        // Only allow omission of creditorAgent if creditorAccount is BBAN
        if ($creditorAgent === null && !($creditorAccount instanceof BBAN)) {
            throw new \InvalidArgumentException('Creditor agent (BIC) is required unless creditor account is a BBAN.');
        }

        if ($creditorAgent && !$creditorAgent instanceof BIC && !$creditorAgent instanceof IID) {
            throw new InvalidArgumentException('The creditor agent must be an instance of BIC or IID.');
        }

        parent::__construct($instructionId, $endToEndId, $amount, $creditorName, $creditorAddress);

        $this->serviceLevel = 'NURG';

        $this->creditorAccount = $creditorAccount;
        $this->creditorAgent = $creditorAgent;
    }

    public function setCreditorAgent(?FinancialInstitutionInterface $creditorAgent): self
    {
        // Optional for domestic transfers
        $this->creditorAgent = $creditorAgent;

        return $this;
    }

    public function asDom(DOMDocument $doc, PaymentInformation $paymentInformation)
    {
        $root = $this->buildHeader($doc, $paymentInformation);

        $root->appendChild($doc->createElement('ChrgBr', 'SHAR'));

        if ($this->creditorAgent) {
            $creditorAgent = $doc->createElement('CdtrAgt');
            $creditorAgent->appendChild($this->creditorAgent->asDom($doc));
            $root->appendChild($creditorAgent);
        }

        $root->appendChild($this->buildCreditor($doc));

        $creditorAccount = $doc->createElement('CdtrAcct');
        $creditorAccount->appendChild($this->creditorAccount->asDom($doc));
        $root->appendChild($creditorAccount);

        $this->appendPurpose($doc, $root);

        $this->appendRemittanceInformation($doc, $root);

        return $root;
    }
}
