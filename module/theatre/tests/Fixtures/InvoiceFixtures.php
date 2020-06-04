<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\Invoice;
use Theatre\InvoicePrinter;

trait InvoiceFixtures
{
    use CustomerFixtures;
    use PerformanceFixtures;

    public function invoice(): Invoice
    {
        return new Invoice($this->customer(), $this->performancesSummary());
    }

    public function invoicePrinter(): InvoicePrinter
    {
        return new InvoicePrinter();
    }
}
