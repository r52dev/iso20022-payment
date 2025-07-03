<?php

namespace R52dev\ISO20022\Money;

/**
 * Sum of money in Danish kroner
 */
class DKK extends Money
{
    /**
     * {@inheritdoc}
     */
    final public function getCurrency()
    {
        return 'DKK';
    }

    /**
     * {@inheritdoc}
     */
    final protected function getDecimals()
    {
        return 2;
    }
}
