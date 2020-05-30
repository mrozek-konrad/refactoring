<?php

declare(strict_types=1);

namespace Theatre\AmountRules;

use InvalidArgumentException;
use Theatre\AmountRule;

class BonusAmountForEachViewerAboveMinimumAudience implements AmountRule
{
    private int $bonusAmount;
    private int $minimumAudience;

    public function __construct(int $bonusAmount, int $minimumAudience)
    {
        if ($minimumAudience <= 0) {
            throw new InvalidArgumentException('Minimum audience must be above zero.');
        }

        if ($bonusAmount <= 0) {
            throw new InvalidArgumentException('Bonus amount for each viewer above minimum audience must be above zero.');
        }

        $this->bonusAmount     = $bonusAmount;
        $this->minimumAudience = $minimumAudience;
    }

    public function calculateAmount(int $audience): int
    {
        $viewersAboveMinimumAudience = max($audience - $this->minimumAudience, 0);

        return $this->bonusAmount * $viewersAboveMinimumAudience;
    }
}