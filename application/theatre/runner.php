<?php

require_once 'vendor/autoload.php';

use Theatre\Amount;
use Theatre\AmountRules;
use Theatre\Audience;
use Theatre\Customer;
use Theatre\Invoice;
use Theatre\Performance;
use Theatre\Performances;
use Theatre\Play;
use Theatre\Plays;

function statement(Invoice $invoice, Plays $plays, AmountRules $amountRulesForComedy, AmountRules $amountRulesForTragedy)
{
    $totalAmount   = Amount::zero();
    $volumeCredits = 0;

    $invoiceCustomer = $invoice->customer()->name();

    $result = "Rachunek dla $invoiceCustomer" . PHP_EOL;

    foreach ($invoice->performances() as $performance) {
        $play = $plays->find($performance->playId());
        $amount = Amount::zero();

        switch ($play->type()) {
            case "tragedy":
                foreach ($amountRulesForTragedy as $amountRule) {
                    $amount = $amount->add($amountRule->calculateAmount($performance->audience()));
                }
                break;
            case "comedy":
                foreach ($amountRulesForComedy as $amountRule) {
                    $amount = $amount->add($amountRule->calculateAmount($performance->audience()));
                }
                break;
            default:
                throw new Exception('Unknown audience type ' . $play->type());
        }

        $volumeCredits += max($performance->audience()->value() - 30, 0);

        if ("comedy" === $play->type()) {
            $volumeCredits += floor($performance->audience()->value() / 5);
        }

        $result      .= ' ' . $play->name() . ': ' . number_format($amount->value() / 100) . ' (liczba miejsc:' . $performance->audience()->value() . ')' . PHP_EOL;
        $totalAmount = $totalAmount->add($amount);
    }

    $result .= "Naleznosc: " . number_format($totalAmount->value() / 100) . PHP_EOL;
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
            new AmountRules\BaseAmountForPerformance(Amount::create(30000)),
            new AmountRules\BonusAmountForAudienceAboveThanMinimumAudience(Amount::create(10000), Audience::create(20)),
            new AmountRules\BonusAmountForEachViewerAboveMinimumAudience(Amount::create(500), Audience::create(20)),
            new AmountRules\BonusAmountForEachViewer(Amount::create(300)),
    ]
);
$amountRulesForTragedy = new AmountRules(
    ... [
            new AmountRules\BaseAmountForPerformance(Amount::create(40000)),
            new AmountRules\BonusAmountForEachViewerAboveMinimumAudience(Amount::create(1000), Audience::create(30)),
    ]
);

foreach ($invoices as $invoice) {
    $performances = [];

    foreach ($invoice['performances'] as $performance) {
        $performances[] = new Performance($performance['playId'], Audience::create($performance['audience']));
    }

    $invoice = new Invoice(new Customer($invoice['customer']), new Performances(...$performances));
    $plays   = new Plays(...$plays);

    echo statement($invoice, $plays, $amountRulesForComedy, $amountRulesForTragedy) . PHP_EOL;
}
