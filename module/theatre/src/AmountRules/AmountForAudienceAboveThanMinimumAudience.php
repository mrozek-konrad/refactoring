<?php

declare(strict_types=1);

namespace Theatre\AmountRules;

use InvalidArgumentException;
use Theatre\AmountRule;

class AmountForAudienceAboveThanMinimumAudience implements AmountRule
{
    public const AMOUNT_IF_AUDIENCE_IS_LOWER_THAN_MINIMUM = 0;

    private int $amountIfAudienceIsAboveMinimum;
    private int $minimumAudience;

    public function __construct(int $amountIfAudienceIsAboveMinimum, int $minimumAudience)
    {
        if ($minimumAudience <= 0) {
            throw new InvalidArgumentException('Minimum audience must be above zero.');
        }

        if ($amountIfAudienceIsAboveMinimum <= 0) {
            throw new InvalidArgumentException('Amount must be above zero.');
        }

        $this->amountIfAudienceIsAboveMinimum = $amountIfAudienceIsAboveMinimum;
        $this->minimumAudience                = $minimumAudience;
    }

    public function calculateAmount(int $audience): int
    {
        $isAudienceAboveMinimum = $audience > $this->minimumAudience;

        return $isAudienceAboveMinimum ? $this->amountIfAudienceIsAboveMinimum : self::AMOUNT_IF_AUDIENCE_IS_LOWER_THAN_MINIMUM;
    }
}