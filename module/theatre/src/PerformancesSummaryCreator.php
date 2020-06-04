<?php

declare(strict_types=1);

namespace Theatre;

class PerformancesSummaryCreator
{
    private AmountCalculator        $amountCalculator;
    private CreditVolumesCalculator $creditVolumesCalculator;

    public function __construct(AmountCalculator $amountCalculator, CreditVolumesCalculator $creditVolumesCalculator)
    {
        $this->amountCalculator        = $amountCalculator;
        $this->creditVolumesCalculator = $creditVolumesCalculator;
    }

    public function createSummary(Performances $performances): PerformancesSummary
    {
        $performancesSummaries = $this->createPerformancesSummaries($performances);
        $totalAmount           = $this->amountCalculator->calculateTotalAmount($performancesSummaries);
        $totalCreditVolumes    = $this->creditVolumesCalculator->calculateTotalCreditVolumes($performancesSummaries);

        return new PerformancesSummary($performancesSummaries, $totalAmount, $totalCreditVolumes);
    }

    private function createPerformanceSummary(Performance $performance): PerformanceSummary
    {
        $performanceCalculatedAmount        = $this->amountCalculator->calculate($performance);
        $performanceCalculatedCreditVolumes = $this->creditVolumesCalculator->calculate($performance);

        return new PerformanceSummary($performance, $performanceCalculatedAmount, $performanceCalculatedCreditVolumes);
    }

    private function createPerformancesSummaries(Performances $performances): PerformancesSummaries
    {
        $performancesSummaries = [];

        foreach ($performances as $performance) {
            $performancesSummaries[] = $this->createPerformanceSummary($performance);
        }

        return new PerformancesSummaries(...$performancesSummaries);
    }
}
