<?php

namespace Theatre\Tests;

use Theatre\Tests\Fixtures\InvoiceFixtures;

class InvoicePrinterTest extends TheatreTestCase
{
    use InvoiceFixtures;

    public function testPrintsInvoiceInCorrectFormat()
    {
        $invoice = $this->invoice();

        $expectedResult = "Rachunek dla " . $invoice->customer()->name() . PHP_EOL;
        foreach ($invoice->performancesSummary()->performancesSummaries() as $performanceSummary) {
            $expectedResult .= ' ' . $performanceSummary->performance()->play()->name()->value() .
                               ': ' . number_format($performanceSummary->amount()->value() / 100, 2) .
                               ' (liczba miejsc: ' . $performanceSummary->performance()->audience()->value() . ')' . PHP_EOL;
        }

        $expectedResult .= "Naleznosc: " . number_format($invoice->performancesSummary()->totalAmount()->value() / 100) . PHP_EOL;
        $expectedResult .= "Punkty promocyjne: " . $invoice->performancesSummary()->totalCreditVolumes()->value() . PHP_EOL;

        $result = $this->invoicePrinter()->print($invoice);

        $this->assertSame($expectedResult, $result);
    }
}
