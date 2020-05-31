<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\Audience;
use Theatre\CreditVolumes;
use Theatre\CreditVolumesRules\BonusCreditsForEachViewerAboveMinimumAudience;
use Theatre\CreditVolumesRules\BonusCreditVolumesForEachSpecifiedNumberOfViewers;

trait CreditVolumesRulesFixtures
{
    use AudienceFixtures;
    use CreditVolumesFixtures;

    final protected function buildBonusCreditsForEachViewerAboveMinimumAudienceRule(
        ?CreditVolumes $creditVolumesForEachViewer = null,
        ?Audience $minimumAudience = null
    ): BonusCreditsForEachViewerAboveMinimumAudience {
        return new BonusCreditsForEachViewerAboveMinimumAudience(
            $creditVolumesForEachViewer ?? $this->creditVolumes(),
            $minimumAudience ?? $this->audience()
        );
    }

    final protected function buildBonusCreditVolumesForEachSpecifiedNumberOfViewersRule(
        ?CreditVolumes $creditVolumesForEachPartOfAudience= null,
        ?Audience $partOfAudienceWhichWillBePrized = null
    ): BonusCreditVolumesForEachSpecifiedNumberOfViewers {
        return new BonusCreditVolumesForEachSpecifiedNumberOfViewers(
            $creditVolumesForEachPartOfAudience ?? $this->creditVolumes(),
            $partOfAudienceWhichWillBePrized ?? $this->audience()
        );
    }
}