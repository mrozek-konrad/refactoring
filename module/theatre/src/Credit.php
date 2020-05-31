<?php

declare(strict_types=1);

namespace Theatre;

use InvalidArgumentException;

class Credit
{
    private int $credit;

    public function __construct(int $credit)
    {
        if ($credit < 0) {
            throw new InvalidArgumentException('Credit cannot be less than zero');
        }
        
        $this->credit = $credit;
    }

    public static function create(int $credit): Credit
    {
        return new self($credit);
    }

    public static function zero(): Credit
    {
        return new self(0);
    }

    public function add(Credit $creditToAdd): Credit
    {
        return new self($this->credit + $creditToAdd->value());
    }

    public function value(): int
    {
        return $this->credit;
    }
}