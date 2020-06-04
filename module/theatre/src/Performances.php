<?php

declare(strict_types=1);

namespace Theatre;

use ArrayIterator;

class Performances extends ArrayIterator
{
    public function __construct(Performance ...$performances)
    {
        parent::__construct($performances);
    }

    public function current(): Performance
    {
        return parent::current();
    }
}
