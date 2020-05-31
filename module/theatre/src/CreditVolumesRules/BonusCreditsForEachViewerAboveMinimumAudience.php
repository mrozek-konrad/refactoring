<?php

declare(strict_types=1);

namespace Theatre\CreditVolumesRules;

use Theatre\Audience;
use Theatre\CreditVolumes;
use Theatre\CreditVolumesRule;

class BonusCreditsForEachViewerAboveMinimumAudience implements CreditVolumesRule
{
    private Audience      $minimumAudience;
    private CreditVolumes $bonusCreditVolumes;

    public function __construct(CreditVolumes $bonusCreditVolumesForEachViewer, Audience $minimumAudience)
    {
        $this->bonusCreditVolumes = $bonusCreditVolumesForEachViewer;
        $this->minimumAudience    = $minimumAudience;
    }

    public function calculateCredit(Audience $audience): CreditVolumes
    {
        $viewersAboveMinimumAudience = $audience->minus($this->minimumAudience);

        return $this->bonusCreditVolumes->multiply($viewersAboveMinimumAudience->value());
    }
}