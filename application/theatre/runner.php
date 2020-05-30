<?php

require_once 'vendor/autoload.php';

use Theatre\AmountRules;
use Theatre\Customer;
use Theatre\Invoice;
use Theatre\Performance;
use Theatre\Performances;
use Theatre\Play;
use Theatre\Plays;

function statement(Invoice $invoice, Plays $plays, AmountRules $amountRulesForComedy, AmountRules $amountRulesForTragedy)
{
    $totalAmount   = 0;
    $volumeCredits = 0;

    $invoiceCustomer = $invoice->customer()->name();

    $result = "Rachunek dla $invoiceCustomer" . PHP_EOL;

    foreach ($invoice->performances() as $performance) {
        $play = $plays->find($performance->playId());
        $amount = 0;

        switch ($play->type()) {
            case "tragedy":
                foreach ($amountRulesForTragedy as $amountRule) {
                    $amount += $amountRule->calculateAmount($performance->audience());
                }
                break;
            case "comedy":
                foreach ($amountRulesForComedy as $amountRule) {
                    $amount += $amountRule->calculateAmount($performance->audience());
                }
                break;
            default:
                throw new Exception('Unknown audience type ' . $play->type());
        }

        $volumeCredits += max($performance->audience() - 30, 0);

        if ("comedy" === $play->type()) {
            $volumeCredits += floor($performance->audience() / 5);
        }

        $result      .= ' ' . $play->name() . ': ' . number_format($amount / 100) . ' (liczba miejsc:' . $performance->audience() . ')' . PHP_EOL;
        $totalAmount += $amount;
    }

    $result .= "Naleznosc: " . number_format($totalAmount / 100) . PHP_EOL;
    $result .= "Punkty promocyjne: " . $volumeCredits . PHP_EOL;

    return $result;
}

$invoices = json_decode(file_get_contents(__DIR__ . '/json/invoices.json'), true);
$rawPlays = json_decode(file_get_contents(__DIR__ . '/json/plays.json'), true);

$plays = [];

foreach ($rawPlays as $id => $rawPlay) {
    $plays[] = new Play($id, $rawPlay['name'], $rawPlay['type']);
}

$amountRulesForComedy = new AmountRules(
    ... [
            new AmountRules\BaseAmountForPerformance(30000),
            new AmountRules\BonusAmountForAudienceAboveThanMinimumAudience(10000, 20),
            new AmountRules\BonusAmountForEachViewerAboveMinimumAudience(500, 20),
            new AmountRules\BonusAmountForEachViewer(300),
    ]
);
$amountRulesForTragedy = new AmountRules(
    ... [
            new AmountRules\BaseAmountForPerformance(40000),
            new AmountRules\BonusAmountForEachViewerAboveMinimumAudience(1000, 30),
    ]
);

foreach ($invoices as $invoice) {
    $performances = [];

    foreach ($invoice['performances'] as $performance) {
        $performances[] = new Performance($performance['playId'], $performance['audience']);
    }

    $invoice = new Invoice(new Customer($invoice['customer']), new Performances(...$performances));
    $plays   = new Plays(...$plays);

    echo statement($invoice, $plays, $amountRulesForComedy, $amountRulesForTragedy) . PHP_EOL;
}
