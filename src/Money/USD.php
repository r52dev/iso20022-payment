<?php

namespace R52dev\ISO20022\Money;

/**
 * Sum of money in U.S. dollars
 */
class USD extends Money
{
    /**
     * {@inheritdoc}
     */
    final public function getCurrency()
    {
        return 'USD';
    }

    /**
     * {@inheritdoc}
     */
    final protected function getDecimals()
    {
        return 2;
    }
}
