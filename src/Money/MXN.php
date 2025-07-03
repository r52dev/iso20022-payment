<?php

namespace R52dev\ISO20022\Money;

/**
 * Sum of money in Mexican pesos
 */
class MXN extends Money
{
    /**
     * {@inheritdoc}
     */
    final public function getCurrency()
    {
        return 'MXN';
    }

    /**
     * {@inheritdoc}
     */
    final protected function getDecimals()
    {
        return 2;
    }
}
