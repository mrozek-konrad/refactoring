<?php

declare(strict_types=1);

namespace Theatre\AmountRules;

use InvalidArgumentException;
use Theatre\AmountRule;

class BonusAmountForEachViewer implements AmountRule
{
    private int $bonusAmountForEachViewer;

    public function __construct(int $bonusAmountForEachViewer)
    {
        if ($bonusAmountForEachViewer <= 0) {
            throw new InvalidArgumentException('Bonus amount for each viewer must be above zero.');
        }

        $this->bonusAmountForEachViewer = $bonusAmountForEachViewer;
    }

    public function calculateAmount(int $audience): int
    {
        return (int) ($this->bonusAmountForEachViewer * $audience);
    }
}