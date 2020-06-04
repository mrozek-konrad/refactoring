<?php

declare(strict_types=1);

namespace Theatre\AmountRules;

use Theatre\Amount;
use Theatre\AmountRule;
use Theatre\Audience;

class BaseAmountForPerformance implements AmountRule
{
    private Amount $amountForPerformance;

    public function __construct(Amount $amountForPerformance)
    {
        $this->amountForPerformance = $amountForPerformance;
    }

    public function calculateAmount(Audience $audience): Amount
    {
        return $this->amountForPerformance;
    }
}
