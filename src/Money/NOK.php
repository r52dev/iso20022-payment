<?php

namespace R52dev\ISO20022\Money;

/**
 * Sum of money in Norwegian kroner
 */
class NOK extends Money
{
    /**
     * {@inheritdoc}
     */
    final public function getCurrency()
    {
        return 'NOK';
    }

    /**
     * {@inheritdoc}
     */
    final protected function getDecimals()
    {
        return 2;
    }
}
