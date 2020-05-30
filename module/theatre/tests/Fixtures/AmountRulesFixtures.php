<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\AmountRules\BaseAmountForPerformance;
use Theatre\AmountRules\BonusAmountForAudienceAboveThanMinimumAudience;
use Theatre\AmountRules\BonusAmountForEachViewer;
use Theatre\AmountRules\BonusAmountForEachViewerAboveMinimumAudience;

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

    protected function buildBaseAmountForPerformanceRule(?int $amountForPerformance = null): BaseAmountForPerformance
    {
        return new BaseAmountForPerformance($amountForPerformance ?? $this->amount());
    }

    protected function buildBonusAmountForAudienceAboveThanMinimumAudienceRule(
        ?int $bonusAmountIfAudienceIsAboveMinimum = null,
        ?int $minimumAudience = null
    ): BonusAmountForAudienceAboveThanMinimumAudience {
        return new BonusAmountForAudienceAboveThanMinimumAudience(
            $bonusAmountIfAudienceIsAboveMinimum ?? $this->amount(),
            $minimumAudience ?? $this->audience(),
        );
    }

    protected function validAmountRulesParams(): array
    {
        $params = [];

        for ($i = 0; $i < $this->randomInt(2, 4); $i++) {
            $params[] = $this->buildBaseAmountForPerformanceRule();
            $params[] = $this->buildBonusAmountForEachViewerRule();
            $params[] = $this->buildBonusAmountForEachViewerAboveMinimumAudienceRule();
            $params[] = $this->buildBonusAmountForAudienceAboveThanMinimumAudienceRule();
        }

        return $params;
    }

    protected function invalidAmountRulesParams(): array
    {
        return [$this->randomInt(PHP_INT_MIN, PHP_INT_MAX), $this->randomInt(PHP_INT_MIN, PHP_INT_MAX)];
    }

    protected function buildBonusAmountForEachViewerAboveMinimumAudienceRule(
        ?int $bonusAmount = null,
        ?int $minimumAudience = null
    ): BonusAmountForEachViewerAboveMinimumAudience {
        return new BonusAmountForEachViewerAboveMinimumAudience(
            $bonusAmount ?? $this->amount(),
            $minimumAudience ?? $this->audience(),
        );
    }

    protected function buildBonusAmountForEachViewerRule(?int $bonusAmountForEachViewer = null): BonusAmountForEachViewer
    {
        return new BonusAmountForEachViewer($bonusAmountForEachViewer ?? $this->amount());
    }
}