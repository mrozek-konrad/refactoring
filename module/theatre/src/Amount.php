<?php

declare(strict_types=1);

namespace Theatre;

use InvalidArgumentException;

class Amount
{
    private int $amount;

    public function __construct(int $amount)
    {
        if ($amount <= 0) {
            throw new InvalidArgumentException('Amount must be above zero.');
        }
        
        $this->amount = $amount;
    }

    public function amount(): int
    {
        return $this->amount;
    }

    public function isLessThan(Amount $amount): bool
    {
        return $this->amount < $amount->amount();
    }

    public function isGreaterThan(Amount $amount): bool
    {
        return $this->amount > $amount->amount();
    }
}