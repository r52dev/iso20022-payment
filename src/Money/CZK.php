<?php

namespace R52dev\ISO20022\Money;

/**
 * Sum of money in Czech koruna
 */
class CZK extends Money
{
    /**
     * {@inheritdoc}
     */
    final public function getCurrency()
    {
        return 'CZK';
    }

    /**
     * {@inheritdoc}
     */
    final protected function getDecimals()
    {
        return 2;
    }
}
