<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\AmountRules\AmountForAudienceAboveThanMinimumAudience;
use Theatre\AmountRules\AmountForEachViewer;
use Theatre\AmountRules\BaseAmountForPerformance;

trait AmountRulesFixtures
{
    use RandomScalarValuesFixtures;

    protected function amount(): int
    {
        return $this->randomInt(1, 100_000_000);
    }

    protected function amountLowerOrEqualsZero(): int
    {
        return $this->randomInt(-100_000_000, 0);
    }

    protected function audience(): int
    {
        return $this->randomInt(1, 100_000);
    }

    protected function audienceAboveThan(int $audience): int
    {
        return $this->randomInt($audience, 100_000_000);
    }

    protected function audienceLowerOrEqualsZero(): int
    {
        return $this->randomInt(-100_000_000, 0);
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

    protected function buildAmountForEachViewerRule(?int $amountForEachViewer = null): AmountForEachViewer
    {
        return new AmountForEachViewer($amountForEachViewer ?? $this->amount());
    }

    protected function buildBaseAmountForPerformanceRule(?int $amountForPerformance = null): BaseAmountForPerformance
    {
        return new BaseAmountForPerformance($amountForPerformance ?? $this->amount());
    }
}