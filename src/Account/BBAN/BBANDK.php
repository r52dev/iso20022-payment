<?php

namespace R52dev\ISO20022\Account\BBAN;


use R52dev\ISO20022\BBAN;

/**
 * BBANDK
 *
 * Danish domestic BBAN based on reg. no. and account no.
 * Formats as a 14-digit string: 4-digit reg. no. + 10-digit account no.
 *
 * @see https://www.nordea.com/Images/34-48937/Nordea_Account_Structure_v1_4.pdf
 */
class BBANDK extends BBAN
{
    public function __construct(string $branchCode, string $accountNumber)
    {
        // Validate branch and account number parts individually
        if (!self::check($branchCode, 4)) {
            throw new \InvalidArgumentException('Invalid Danish branch code.');
        }
        if (!self::check($accountNumber, 10)) {
            throw new \InvalidArgumentException('Invalid Danish account number.');
        }

        $this->accountNumber = str_pad($branchCode, 4, '0', STR_PAD_LEFT)
        . str_pad($accountNumber, 10, '0', STR_PAD_LEFT);
    }
}
