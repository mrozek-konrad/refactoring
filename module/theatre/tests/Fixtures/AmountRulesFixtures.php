<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\AmountRules\AmountForAudienceAboveThanMinimumAudience;

trait AmountRulesFixtures
{
    use RandomScalarValuesFixtures;

    protected function amount(): int
    {
        return $this->randomInt(1, PHP_INT_MAX);
    }

    protected function amountLowerOrEqualsZero(): int
    {
        return $this->randomInt(PHP_INT_MIN, 0);
    }

    protected function audience(): int
    {
        return $this->randomInt(1, PHP_INT_MAX);
    }

    protected function audienceAboveThan(int $audience): int
    {
        return $this->randomInt($audience, PHP_INT_MAX);
    }

    protected function audienceLowerOrEqualsZero(): int
    {
        return $this->randomInt(PHP_INT_MIN, 0);
    }

    protected function audienceLowerThan(int $audience): int
    {
        return $this->randomInt(1, $audience - 1);
    }

    protected function buildAmountForAudienceAboveThanMinimumAudienceRule(
        ?int $amountIfAudienceIsAboveMinimum = null,
        ?int $minimumAudience = null
    ): AmountForAudienceAboveThanMinimumAudience {
        return new AmountForAudienceAboveThanMinimumAudience(
            $amountIfAudienceIsAboveMinimum ?? $this->amount(),
            $minimumAudience ?? $this->audience(),
        );
    }
}