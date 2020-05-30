<?php

declare(strict_types=1);

namespace Theatre\AmountRules;

use Theatre\Amount;
use Theatre\AmountRule;

class BonusAmountForEachViewer implements AmountRule
{
    private Amount $bonusAmountForEachViewer;

    public function __construct(Amount $bonusAmountForEachViewer)
    {
        $this->bonusAmountForEachViewer = $bonusAmountForEachViewer;
    }

    public function calculateAmount(int $audience): Amount
    {
        return $this->bonusAmountForEachViewer->multiply($audience);
    }
}