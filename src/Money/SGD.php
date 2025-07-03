<?php

namespace R52dev\ISO20022\Money;

/**
 * Sum of money in Singapore dollars
 */
class SGD extends Money
{
    /**
     * {@inheritdoc}
     */
    final public function getCurrency()
    {
        return 'SGD';
    }

    /**
     * {@inheritdoc}
     */
    final protected function getDecimals()
    {
        return 2;
    }
}
