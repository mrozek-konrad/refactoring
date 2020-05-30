<?php

declare(strict_types=1);

namespace Theatre\AmountRules;

use InvalidArgumentException;
use Theatre\AmountRule;

class BonusAmountForAudienceAboveThanMinimumAudience implements AmountRule
{
    public const BONUS_AMOUNT_IF_AUDIENCE_IS_LOWER_THAN_MINIMUM = 0;

    private int $bonusAmountIfAudienceIsAboveThanMinimum;
    private int $minimumAudience;

    public function __construct(int $bonusAmountIfAudienceIsAboveThanMinimum, int $minimumAudience)
    {
        if ($minimumAudience <= 0) {
            throw new InvalidArgumentException('Minimum audience must be above zero.');
        }

        if ($bonusAmountIfAudienceIsAboveThanMinimum <= 0) {
            throw new InvalidArgumentException('Bonus amount if audience is above than minimum must be above zero.');
        }

        $this->bonusAmountIfAudienceIsAboveThanMinimum = $bonusAmountIfAudienceIsAboveThanMinimum;
        $this->minimumAudience                         = $minimumAudience;
    }

    public function calculateAmount(int $audience): int
    {
        $audienceIsAboveThanMinimum = $audience > $this->minimumAudience;

        return $audienceIsAboveThanMinimum ? $this->bonusAmountIfAudienceIsAboveThanMinimum : self::BONUS_AMOUNT_IF_AUDIENCE_IS_LOWER_THAN_MINIMUM;
    }
}