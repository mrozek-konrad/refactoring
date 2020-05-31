<?php

declare(strict_types=1);

namespace Theatre;

class PerformanceSummary
{
    private Performance   $performance;
    private Amount        $amount;
    private CreditVolumes $creditVolumes;

    public function __construct(Performance $performance, Amount $amount, CreditVolumes $creditVolumes)
    {
        $this->performance   = $performance;
        $this->amount        = $amount;
        $this->creditVolumes = $creditVolumes;
    }

    public function amount(): Amount
    {
        return $this->amount;
    }

    public function creditVolumes(): CreditVolumes
    {
        return $this->creditVolumes;
    }

    public function performance(): Performance
    {
        return $this->performance;
    }
}