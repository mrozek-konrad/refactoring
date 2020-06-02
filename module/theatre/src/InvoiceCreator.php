<?php

declare(strict_types=1);

namespace Theatre;

class InvoiceCreator
{
    private PerformancesSummaryCreator $performanceSummaryCreator;

    public function __construct(PerformancesSummaryCreator $performanceSummaryCreator)
    {
        $this->performanceSummaryCreator = $performanceSummaryCreator;
    }

    public function create(Customer $customer, Performances $performances): Invoice
    {
        $performancesSummary = $this->performanceSummaryCreator->createSummary($performances);

        return new Invoice($customer, $performancesSummary);
    }
}