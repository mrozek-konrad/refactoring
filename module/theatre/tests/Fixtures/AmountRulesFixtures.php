<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\Amount;
use Theatre\AmountRule;
use Theatre\AmountRules;
use Theatre\AmountRules\BaseAmountForPerformance;
use Theatre\AmountRules\BonusAmountForAudienceAboveThanMinimumAudience;
use Theatre\AmountRules\BonusAmountForEachViewer;
use Theatre\AmountRules\BonusAmountForEachViewerAboveMinimumAudience;
use Theatre\Audience;

trait AmountRulesFixtures
{
    use AudienceFixtures;
    use AmountFixtures;

    final protected function amountRule(): AmountRule
    {
        switch ($this->value(1, 4)) {
            case 1:
                return $this->buildBaseAmountForPerformanceRule();
            case 2:
                return $this->buildBonusAmountForEachViewerRule();
            case 3:
                return $this->buildBonusAmountForEachViewerAboveMinimumAudienceRule();
            default:
                return $this->buildBonusAmountForAudienceAboveThanMinimumAudienceRule();
        }
    }

    final protected function buildBaseAmountForPerformanceRule(?Amount $amountForPerformance = null): BaseAmountForPerformance
    {
        return new BaseAmountForPerformance($amountForPerformance ?? $this->amount());
    }

    final protected function buildBonusAmountForAudienceAboveThanMinimumAudienceRule(
        ?Amount $bonusAmountIfAudienceIsAboveMinimum = null,
        ?Audience $minimumAudience = null
    ): BonusAmountForAudienceAboveThanMinimumAudience {
        return new BonusAmountForAudienceAboveThanMinimumAudience(
            $bonusAmountIfAudienceIsAboveMinimum ?? $this->amount(),
            $minimumAudience ?? $this->audience(),
        );
    }

    final protected function buildBonusAmountForEachViewerAboveMinimumAudienceRule(
        ?Amount $bonusAmount = null,
        ?Audience $minimumAudience = null
    ): BonusAmountForEachViewerAboveMinimumAudience {
        return new BonusAmountForEachViewerAboveMinimumAudience(
            $bonusAmount ?? $this->amount(),
            $minimumAudience ?? $this->audience(),
        );
    }

    final protected function buildBonusAmountForEachViewerRule(?Amount $bonusAmountForEachViewer = null): BonusAmountForEachViewer
    {
        return new BonusAmountForEachViewer($bonusAmountForEachViewer ?? $this->amount());
    }

    final protected function invalidAmountRulesParams(): array
    {
        return $this->arrayOf(fn() => $this->mediumValue());
    }

    final protected function validAmountRulesParams(): array
    {
        return $this->arrayOf(fn() => $this->amountRule());
    }
}