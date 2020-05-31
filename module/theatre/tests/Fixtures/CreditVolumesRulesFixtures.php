<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\Audience;
use Theatre\CreditVolumes;
use Theatre\CreditVolumesRule;
use Theatre\CreditVolumesRules\BonusCreditsForEachViewerAboveMinimumAudience;
use Theatre\CreditVolumesRules\BonusCreditVolumesForEachSpecifiedNumberOfViewers;

trait CreditVolumesRulesFixtures
{
    use AudienceFixtures;
    use CreditVolumesFixtures;

    final protected function buildBonusCreditVolumesForEachSpecifiedNumberOfViewersRule(
        ?CreditVolumes $creditVolumesForEachPartOfAudience = null,
        ?Audience $partOfAudienceWhichWillBePrized = null
    ): BonusCreditVolumesForEachSpecifiedNumberOfViewers {
        return new BonusCreditVolumesForEachSpecifiedNumberOfViewers(
            $creditVolumesForEachPartOfAudience ?? $this->creditVolumes(),
            $partOfAudienceWhichWillBePrized ?? $this->audience()
        );
    }

    final protected function buildBonusCreditsForEachViewerAboveMinimumAudienceRule(
        ?CreditVolumes $creditVolumesForEachViewer = null,
        ?Audience $minimumAudience = null
    ): BonusCreditsForEachViewerAboveMinimumAudience {
        return new BonusCreditsForEachViewerAboveMinimumAudience(
            $creditVolumesForEachViewer ?? $this->creditVolumes(),
            $minimumAudience ?? $this->audience()
        );
    }

    final protected function creditVolumesRule(): CreditVolumesRule
    {
        if ($this->value(0, 1)) {
            return $this->buildBonusCreditVolumesForEachSpecifiedNumberOfViewersRule();
        }

        return $this->buildBonusCreditsForEachViewerAboveMinimumAudienceRule();
    }

    final protected function invalidCreditVolumesParams(): array
    {
        return $this->arrayOf(fn() => $this->mediumValue());
    }

    final protected function validCreditVolumesParams(): array
    {
        return $this->arrayOf(fn() => $this->creditVolumesRule());
    }
}