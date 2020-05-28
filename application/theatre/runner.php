<?php

require_once 'vendor/autoload.php';

use Theatre\Customer;
use Theatre\Invoice;
use Theatre\Performance;
use Theatre\Performances;

function statement(Invoice $invoice, array $plays)
{
    $totalAmount   = 0;
    $volumeCredits = 0;

    $invoiceCustomer = $invoice->customer()->name();

    $result = "Rachunek dla $invoiceCustomer" . PHP_EOL;

    foreach ($invoice->performances() as $performance) {
        $play   = $plays[$performance->playId()];
        $amount = 0;

        switch ($play['type']) {
            case "tragedy":
                $amount = 40000;
                if ($performance->audience() > 30) {
                    $amount += 1000 * ($performance->audience() - 30);
                }
                break;
            case "comedy":
                $amount = 30000;
                if ($performance->audience() > 20) {
                    $amount += 10000 + 500 * ($performance->audience() - 20);
                }
                $amount += 300 * $performance->audience();
                break;
            default:
                throw new Exception('Unknown audience type ' . $play['type']);
        }

        $volumeCredits += max($performance->audience() - 30, 0);

        if ("comedy" === $play['type']) {
            $volumeCredits += floor($performance->audience() / 5);
        }

        $result      .= ' ' . $play['name'] . ': ' . number_format($amount / 100) . ' (liczba miejsc:' . $performance->audience() . ')' . PHP_EOL;
        $totalAmount += $amount;
    }

    $result .= "Naleznosc: " . number_format($totalAmount / 100) . PHP_EOL;
    $result .= "Punkty promocyjne: " . $volumeCredits . PHP_EOL;

    return $result;
}

$invoices = json_decode(file_get_contents(__DIR__ . '/json/invoices.json'), true);
$plays    = json_decode(file_get_contents(__DIR__ . '/json/plays.json'), true);

foreach ($invoices as $invoice) {
    $performances = [];

    foreach ($invoice['performances'] as $performance) {
        $performances[] = new Performance($performance['playId'], $performance['audience']);
    }

    $invoice = new Invoice(new Customer($invoice['customer']), new Performances(...$performances));

    echo statement($invoice, $plays) . PHP_EOL;
}
