<?php

declare(strict_types=1);

namespace Theatre\AmountRules;

use InvalidArgumentException;
use Theatre\AmountRule;

class BaseAmountForPerformance implements AmountRule
{
    private int $amountForPerformance;

    public function __construct(int $amountForPerformance)
    {
        if ($amountForPerformance <= 0) {
            throw new InvalidArgumentException('Amount for performance must be above zero.');
        }

        $this->amountForPerformance = $amountForPerformance;
    }

    public function calculateAmount(int $audience): int
    {
        return $this->amountForPerformance;
    }
}