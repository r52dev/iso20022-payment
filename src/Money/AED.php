<?php

namespace R52dev\ISO20022\Money;

/**
 * Sum of money in UAE dirhams
 */
class AED extends Money
{
    /**
     * {@inheritdoc}
     */
    final public function getCurrency()
    {
        return 'AED';
    }

    /**
     * {@inheritdoc}
     */
    final protected function getDecimals()
    {
        return 2;
    }
}
