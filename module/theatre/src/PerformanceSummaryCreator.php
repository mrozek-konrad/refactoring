<?php

declare(strict_types=1);

namespace Theatre;

class PerformanceSummaryCreator
{
    private AmountCalculator        $amountCalculator;
    private CreditVolumesCalculator $creditVolumesCalculator;

    public function __construct(AmountCalculator $amountCalculator, CreditVolumesCalculator $creditVolumesCalculator)
    {
        $this->amountCalculator        = $amountCalculator;
        $this->creditVolumesCalculator = $creditVolumesCalculator;
    }

    public function create(Performance $performance): PerformanceSummary
    {
        $performanceCalculatedAmount        = $this->amountCalculator->calculate($performance);
        $performanceCalculatedCreditVolumes = $this->creditVolumesCalculator->calculate($performance);

        return new PerformanceSummary($performance, $performanceCalculatedAmount, $performanceCalculatedCreditVolumes);
    }
}