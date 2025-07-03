<?php

namespace R52dev\ISO20022\PaymentInformation;

use R52dev\ISO20022\FinancialInstitutionInterface;
use R52dev\ISO20022\IBAN;

/**
 * SEPAPaymentInformation contains a group of SEPA transactions
 */
class SEPAPaymentInformation extends PaymentInformation
{
    /**
     * {@inheritdoc}
     */
    public function __construct($id, $debtorName, FinancialInstitutionInterface $debtorAgent, IBAN $debtorIBAN)
    {
        parent::__construct($id, $debtorName, $debtorAgent, $debtorIBAN);
        $this->serviceLevel = 'SEPA';
    }
}
