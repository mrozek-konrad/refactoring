<?php

declare(strict_types=1);

namespace Theatre\AmountRules;

use InvalidArgumentException;
use Theatre\Amount;
use Theatre\AmountRule;

class BonusAmountForEachViewerAboveMinimumAudience implements AmountRule
{
    private Amount $bonusAmount;
    private int $minimumAudience;

    public function __construct(Amount $bonusAmount, int $minimumAudience)
    {
        if ($minimumAudience <= 0) {
            throw new InvalidArgumentException('Minimum audience must be above zero.');
        }

        $this->bonusAmount     = $bonusAmount;
        $this->minimumAudience = $minimumAudience;
    }

    public function calculateAmount(int $audience): Amount
    {
        $viewersAboveMinimumAudience = max($audience - $this->minimumAudience, 0);

        return $this->bonusAmount->multiply($viewersAboveMinimumAudience);
    }
}