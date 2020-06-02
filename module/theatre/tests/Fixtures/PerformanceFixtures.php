<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\Performance;
use Theatre\Performances;
use Theatre\PerformancesSummaries;
use Theatre\PerformanceSummary;

trait PerformanceFixtures
{
    use PlayFixtures;
    use AudienceFixtures;
    use AmountFixtures;
    use CreditVolumesFixtures;

    final protected function invalidPerformancesParams(): array
    {
        return $this->arrayOf(fn() => $this->largeValue());
    }

    final protected function invalidPerformancesSummariesParams(): array
    {
        return $this->arrayOf(fn() => $this->largeValue());
    }

    protected function performance(): Performance
    {
        return new Performance($this->play(), $this->audience());
    }

    protected function performanceSummary(): PerformanceSummary
    {
        return new PerformanceSummary($this->performance(), $this->amount(), $this->creditVolumes());
    }

    protected function performances(): Performances
    {
        return new Performances(...$this->validPerformanceParams());
    }

    protected function performancesSummaries(): PerformancesSummaries
    {
        return new PerformancesSummaries(...$this->validPerformancesSummariesParams());
    }

    protected function validPerformanceParams(): array
    {
        return $this->arrayOf(fn() => $this->performance());
    }

    protected function validPerformancesSummariesParams(): array
    {
        return $this->arrayOf(fn() => $this->performanceSummary());
    }
}