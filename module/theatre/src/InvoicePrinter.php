<?php

declare(strict_types=1);

namespace Theatre;

class InvoicePrinter
{
    public function print(Invoice $invoice): string
    {
        $result = $this->printCustomerInfo($invoice->customer());
        $result .= $this->printPerformancesSummary($invoice->performancesSummary());

        return $result;
    }

    private function printCustomerInfo(Customer $customer): string
    {
        return "Rachunek dla " . $customer->name() . PHP_EOL;
    }

    private function printPerformanceSummary(PerformanceSummary $performanceSummary): string
    {
        $result = $this->formatPlay($performanceSummary->performance());
        $result .= $this->formatAmount($performanceSummary->amount());
        $result .= $this->formatAudience($performanceSummary->performance()) . PHP_EOL;

        return $result;
    }

    private function printPerformancesSummary(PerformancesSummary $performancesSummary): string
    {
        $result = '';

        foreach ($performancesSummary->performancesSummaries() as $performanceSummary) {
            $result .= $this->printPerformanceSummary($performanceSummary);
        }

        $result .= $this->formatTotalAmount($performancesSummary);
        $result .= $this->formatTotalCreditVolumes($performancesSummary);

        return $result;
    }

    private function formatAmount(Amount $amount): string
    {
        return number_format($amount->value() / 100, 2);
    }

    private function formatAudience(Performance $performance): string
    {
        return ' (liczba miejsc: ' . $performance->audience()->value() . ')';
    }

    private function formatPlay(Performance $performance): string
    {
        return ' ' . $performance->play()->name() . ': ';
    }

    private function formatTotalAmount(PerformancesSummary $performancesSummary): string
    {
        return "Naleznosc: " . number_format($performancesSummary->totalAmount()->value() / 100) . PHP_EOL;
    }

    private function formatTotalCreditVolumes(PerformancesSummary $performancesSummary): string
    {
        return "Punkty promocyjne: " . $performancesSummary->totalCreditVolumes()->value() . PHP_EOL;
    }
}