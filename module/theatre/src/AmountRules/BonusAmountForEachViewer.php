<?php

declare(strict_types=1);

namespace Theatre\AmountRules;

use Theatre\Amount;
use Theatre\AmountRule;
use Theatre\Audience;

class BonusAmountForEachViewer implements AmountRule
{
    private Amount $bonusAmountForEachViewer;

    public function __construct(Amount $bonusAmountForEachViewer)
    {
        $this->bonusAmountForEachViewer = $bonusAmountForEachViewer;
    }

    public function calculateAmount(Audience $audience): Amount
    {
        return $this->bonusAmountForEachViewer->multiply($audience->value());
    }
}
