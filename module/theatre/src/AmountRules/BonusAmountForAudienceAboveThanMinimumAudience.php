<?php

declare(strict_types=1);

namespace Theatre\AmountRules;

use InvalidArgumentException;
use Theatre\Amount;
use Theatre\AmountRule;

class BonusAmountForAudienceAboveThanMinimumAudience implements AmountRule
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
        $audienceIsAboveThanMinimum = $audience > $this->minimumAudience;

        if (!$audienceIsAboveThanMinimum) {
            return Amount::zero();
        }

        return $this->bonusAmount;
    }
}