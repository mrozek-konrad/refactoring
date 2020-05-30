<?php

declare(strict_types=1);

namespace Theatre\AmountRules;

use InvalidArgumentException;
use Theatre\Amount;
use Theatre\AmountRule;
use Theatre\Audience;

class BonusAmountForAudienceAboveThanMinimumAudience implements AmountRule
{
    private Amount $bonusAmount;
    private Audience $minimumAudience;

    public function __construct(Amount $bonusAmount, Audience $minimumAudience)
    {
        $this->bonusAmount     = $bonusAmount;
        $this->minimumAudience = $minimumAudience;
    }

    public function calculateAmount(Audience $audience): Amount
    {
        if ($audience->isLessThan($this->minimumAudience)) {
            return Amount::zero();
        }

        return $this->bonusAmount;
    }
}