<?php

declare(strict_types=1);

namespace Theatre;

use RuntimeException;

class AmountCalculator
{
    private array $amountRules = [];

    public function addAmountRules(Play\Type $playType, AmountRules $amountRules): void
    {
        $this->amountRules[$playType->value()] = $amountRules;
    }

    public function calculate(Performance $performance): Amount
    {
        $amountRules = $this->amountRules($performance->play()->type());

        $amount = Amount::zero();

        foreach ($amountRules as $amountRule) {
            $calculatedAmount = $amountRule->calculateAmount($performance->audience());

            $amount = $amount->add($calculatedAmount);
        }

        return $amount;
    }

    public function calculateTotalAmount(PerformancesSummaries $performancesSummaries): Amount
    {
        $totalAmount = Amount::zero();

        foreach ($performancesSummaries as $performancesSummary) {
            $totalAmount = $totalAmount->add($performancesSummary->amount());
        }

        return $totalAmount;
    }

    public function amountRules(Play\Type $playType): AmountRules
    {
        if (! array_key_exists($playType->value(), $this->amountRules)) {
            throw new RuntimeException('Amount rules for play ' . $playType->value() . ' are not set.');
        }

        return $this->amountRules[$playType->value()];
    }
}
