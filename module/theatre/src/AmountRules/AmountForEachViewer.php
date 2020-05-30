<?php

declare(strict_types=1);

namespace Theatre\AmountRules;

use InvalidArgumentException;
use Theatre\AmountRule;

class AmountForEachViewer implements AmountRule
{
    private int $amountForEachViewer;

    public function __construct(int $amountForEachViewer)
    {
        if ($amountForEachViewer <= 0) {
            throw new InvalidArgumentException('Amount must be above zero.');
        }

        $this->amountForEachViewer = $amountForEachViewer;
    }

    public function calculateAmount(int $audience): int
    {
        return (int) ($this->amountForEachViewer * $audience);
    }
}