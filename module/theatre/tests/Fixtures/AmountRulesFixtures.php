<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\Amount;
use Theatre\AmountRules\BaseAmountForPerformance;
use Theatre\AmountRules\BonusAmountForAudienceAboveThanMinimumAudience;
use Theatre\AmountRules\BonusAmountForEachViewer;
use Theatre\AmountRules\BonusAmountForEachViewerAboveMinimumAudience;
use Theatre\Audience;

trait AmountRulesFixtures
{
    use RandomScalarValuesFixtures;

    protected function amount(): Amount
    {
        return Amount::create($this->randomInt(1, 100_000_000));
    }

    protected function amountValue(): int
    {
        return $this->randomInt(1, 100_000_000);
    }

    protected function amountValueGreaterThan($amount): int
    {
        return $this->randomInt($amount, 100_000_000);
    }

    protected function amountValueLessThan($amount): int
    {
        return $this->randomInt(1, $amount);
    }

    protected function amountValueLessThanZero(): int
    {
        return $this->randomInt(-100_000_000, -1);
    }

    protected function audience(): Audience
    {
        return Audience::create($this->randomInt(1, 100_000));
    }

    protected function audienceAboveThan(Audience $audience): Audience
    {
        return Audience::create($this->randomInt($audience->value(), 100_000_000));
    }

    protected function audienceLowerThan(Audience $audience): Audience
    {
        return Audience::create($this->randomInt(1, $audience->value() - 1));
    }

    protected function audienceValue(): int
    {
        return $this->randomInt(1, 100_000);
    }

    protected function audienceValueLowerOrEqualsZero(): int
    {
        return $this->randomInt(-100_000_000, 0);
    }

    protected function buildBaseAmountForPerformanceRule(?Amount $amountForPerformance = null): BaseAmountForPerformance
    {
        return new BaseAmountForPerformance($amountForPerformance ?? $this->amount());
    }

    protected function buildBonusAmountForAudienceAboveThanMinimumAudienceRule(
        ?Amount $bonusAmountIfAudienceIsAboveMinimum = null,
        ?Audience $minimumAudience = null
    ): BonusAmountForAudienceAboveThanMinimumAudience {
        return new BonusAmountForAudienceAboveThanMinimumAudience(
            $bonusAmountIfAudienceIsAboveMinimum ?? $this->amount(),
            $minimumAudience ?? $this->audience(),
        );
    }

    protected function buildBonusAmountForEachViewerAboveMinimumAudienceRule(
        ?Amount $bonusAmount = null,
        ?Audience $minimumAudience = null
    ): BonusAmountForEachViewerAboveMinimumAudience {
        return new BonusAmountForEachViewerAboveMinimumAudience(
            $bonusAmount ?? $this->amount(),
            $minimumAudience ?? $this->audience(),
        );
    }

    protected function buildBonusAmountForEachViewerRule(?Amount $bonusAmountForEachViewer = null): BonusAmountForEachViewer
    {
        return new BonusAmountForEachViewer($bonusAmountForEachViewer ?? $this->amount());
    }

    protected function invalidAmountRulesParams(): array
    {
        return [$this->randomInt(PHP_INT_MIN, PHP_INT_MAX), $this->randomInt(PHP_INT_MIN, PHP_INT_MAX)];
    }

    protected function smallValue(): int
    {
        return $this->randomInt(1, 100);
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
}