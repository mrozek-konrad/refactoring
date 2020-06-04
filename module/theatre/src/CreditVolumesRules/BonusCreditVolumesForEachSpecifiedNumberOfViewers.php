<?php

declare(strict_types=1);

namespace Theatre\CreditVolumesRules;

use Theatre\Audience;
use Theatre\CreditVolumes;
use Theatre\CreditVolumesRule;

class BonusCreditVolumesForEachSpecifiedNumberOfViewers implements CreditVolumesRule
{
    private Audience      $partOfAudienceWhichWillBePrized;
    private CreditVolumes $creditVolumesForEachPartOfAudience;

    public function __construct(CreditVolumes $creditVolumesForEachPartOfAudience, Audience $partOfAudienceWhichWillBePrized)
    {
        $this->creditVolumesForEachPartOfAudience = $creditVolumesForEachPartOfAudience;
        $this->partOfAudienceWhichWillBePrized    = $partOfAudienceWhichWillBePrized;
    }

    public function calculateCredit(Audience $audience): CreditVolumes
    {
        $numberOfPrizes = (int) (floor($audience->value() / $this->partOfAudienceWhichWillBePrized->value()) ?? 0);

        return $this->creditVolumesForEachPartOfAudience->multiply($numberOfPrizes);
    }
}
