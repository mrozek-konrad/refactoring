<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\Audience;
use Theatre\CreditVolumes;
use Theatre\CreditVolumesRules\BonusCreditsForEachViewerAboveMinimumAudience;

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
}