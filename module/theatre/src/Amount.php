<?php

declare(strict_types=1);

namespace Theatre;

use InvalidArgumentException;

class Amount
{
    private int $amount;

    public function __construct(int $amount)
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Amount cannot be less than zero');
        }
        
        $this->amount = $amount;
    }

    public static function create(int $amount): Amount
    {
        return new self($amount);
    }

    public static function zero(): Amount
    {
        return new self(0);
    }

    public function areEquals(Amount $amount): bool
    {
        return $this->amount === $amount->amount;
    }

    public function add(Amount $amountToAdd): Amount
    {
        return new self($this->amount + $amountToAdd->amount());
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

    public function multiply(int $value): Amount
    {
        return new self($this->amount * $value);
    }
}