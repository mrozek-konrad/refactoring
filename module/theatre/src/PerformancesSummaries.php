<?php

declare(strict_types=1);

namespace Theatre;

use ArrayIterator;

class PerformancesSummaries extends ArrayIterator
{
    public function __construct(PerformanceSummary ...$performancesSummaries)
    {
        parent::__construct($performancesSummaries);
    }

    public function current(): PerformanceSummary
    {
        return parent::current();
    }
}