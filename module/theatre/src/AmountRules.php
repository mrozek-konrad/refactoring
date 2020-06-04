<?php

declare(strict_types=1);

namespace Theatre;

use ArrayIterator;

class AmountRules extends ArrayIterator
{
    public function __construct(AmountRule ...$amountRules)
    {
        parent::__construct($amountRules);
    }

    public function current(): AmountRule
    {
        return parent::current();
    }
}
