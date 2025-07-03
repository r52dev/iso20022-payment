<?php

namespace R52dev\ISO20022\Money;

/**
 * Sum of money in South African rand
 */
class ZAR extends Money
{
    /**
     * {@inheritdoc}
     */
    final public function getCurrency()
    {
        return 'ZAR';
    }

    /**
     * {@inheritdoc}
     */
    final protected function getDecimals()
    {
        return 2;
    }
}
