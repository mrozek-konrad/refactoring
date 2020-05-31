<?php

declare(strict_types=1);

namespace Theatre;

use ArrayIterator;

class CreditVolumesRules extends ArrayIterator
{
    public function __construct(CreditVolumesRule ...$creditVolumesRules)
    {
        parent::__construct($creditVolumesRules);
    }

    public function current(): CreditVolumesRule
    {
        return parent::current();
    }
}