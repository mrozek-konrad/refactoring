<?php

declare(strict_types=1);

namespace Theatre;

use ArrayIterator;

class Plays extends ArrayIterator
{
    public function __construct(Play ...$plays)
    {
        parent::__construct($plays);
    }

    public function current(): Play
    {
        return parent::current();
    }
}