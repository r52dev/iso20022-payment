<?php

namespace R52dev\ISO20022\Money;

/**
 * Sum of money in Japanese yen
 */
class JPY extends Money
{
    /**
     * {@inheritdoc}
     */
    final public function getCurrency()
    {
        return 'JPY';
    }

    /**
     * {@inheritdoc}
     */
    final protected function getDecimals()
    {
        return 0;
    }
}
