<?php

namespace R52dev\ISO20022\Money;

/**
 * Sum of money in Swedish kronor
 */
class SEK extends Money
{
    /**
     * {@inheritdoc}
     */
    final public function getCurrency()
    {
        return 'SEK';
    }

    /**
     * {@inheritdoc}
     */
    final protected function getDecimals()
    {
        return 2;
    }
}
