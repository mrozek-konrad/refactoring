<?php

declare(strict_types=1);

namespace Theatre;

class Invoice
{
    private Customer            $customer;
    private PerformancesSummary $performancesSummary;

    public function __construct(Customer $customer, PerformancesSummary $performancesSummary)
    {
        $this->customer            = $customer;
        $this->performancesSummary = $performancesSummary;
    }

    public function customer(): Customer
    {
        return $this->customer;
    }

    public function performancesSummary(): PerformancesSummary
    {
        return $this->performancesSummary;
    }
}
