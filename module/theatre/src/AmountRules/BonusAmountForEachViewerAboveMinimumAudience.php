<?php

declare(strict_types=1);

namespace Theatre\AmountRules;

use Theatre\Amount;
use Theatre\AmountRule;
use Theatre\Audience;

class BonusAmountForEachViewerAboveMinimumAudience implements AmountRule
{
    private Amount   $bonusAmount;
    private Audience $minimumAudience;

    public function __construct(Amount $bonusAmount, Audience $minimumAudience)
    {
        $this->bonusAmount     = $bonusAmount;
        $this->minimumAudience = $minimumAudience;
    }

    public function calculateAmount(Audience $audience): Amount
    {
        $viewersAboveMinimumAudience = $audience->minus($this->minimumAudience);

        return $this->bonusAmount->multiply($viewersAboveMinimumAudience->value());
    }
}
