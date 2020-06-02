<?php

declare(strict_types=1);

namespace Theatre;

class PerformancesSummary
{
    private PerformancesSummaries $performancesSummaries;
    private Amount                $totalAmount;
    private CreditVolumes         $totalCreditVolumes;

    public function __construct(
        PerformancesSummaries $performancesSummaries,
        Amount $totalAmountOfPerformances,
        CreditVolumes $totalCreditVolumesOfPerformances
    ) {
        $this->performancesSummaries = $performancesSummaries;
        $this->totalAmount           = $totalAmountOfPerformances;
        $this->totalCreditVolumes    = $totalCreditVolumesOfPerformances;
    }

    public function performancesSummaries(): PerformancesSummaries
    {
        return $this->performancesSummaries;
    }

    public function totalAmount(): Amount
    {
        return $this->totalAmount;
    }

    public function totalCreditVolumes(): CreditVolumes
    {
        return $this->totalCreditVolumes;
    }
}