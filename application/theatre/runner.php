<?php

require_once 'vendor/autoload.php';

use Theatre\Amount;
use Theatre\AmountCalculator;
use Theatre\AmountRules;
use Theatre\Audience;
use Theatre\CreditVolumes;
use Theatre\CreditVolumesCalculator;
use Theatre\CreditVolumesRules;
use Theatre\Customer;
use Theatre\Invoice;
use Theatre\Performance;
use Theatre\Performances;
use Theatre\Play;
use Theatre\Plays;

function statement(Invoice $invoice, Plays $plays, AmountCalculator $amountCalculator, CreditVolumesCalculator $creditVolumesCalculator)
{
    $totalAmount   = Amount::zero();
    $volumeCredits = CreditVolumes::zero();

    $invoiceCustomer = $invoice->customer()->name();

    $result = "Rachunek dla $invoiceCustomer" . PHP_EOL;

    foreach ($invoice->performances() as $performance) {
        $play          = $plays->find($performance->play()->id());
        $amount        = $amountCalculator->calculate($performance);
        $creditVolumes = $creditVolumesCalculator->calculate($performance);

        $totalAmount   = $totalAmount->add($amount);
        $volumeCredits = $volumeCredits->add($creditVolumes);

        $result        .= ' ' . $play->name()->value() . ': ' . number_format($amount->value() / 100) .
                          ' (liczba miejsc:' . $performance->audience()->value() . ')' . PHP_EOL;
    }

    $result .= "Naleznosc: " . number_format($totalAmount->value() / 100) . PHP_EOL;
    $result .= "Punkty promocyjne: " . $volumeCredits->value() . PHP_EOL;

    return $result;
}

$invoices = json_decode(file_get_contents(__DIR__ . '/json/invoices.json'), true);
$rawPlays = json_decode(file_get_contents(__DIR__ . '/json/plays.json'), true);

$plays = [];

foreach ($rawPlays as $id => $rawPlay) {
    $plays[] = new Play(Play\Id::create($id), Play\Name::create($rawPlay['name']), Play\Type::create($rawPlay['type']));
}

$amountCalculator = new AmountCalculator();
$amountCalculator->addAmountRules(
    Play\Type::create('comedy'),
    new AmountRules(
        ... [
                new AmountRules\BaseAmountForPerformance(Amount::create(30000)),
                new AmountRules\BonusAmountForAudienceAboveThanMinimumAudience(Amount::create(10000), Audience::create(20)),
                new AmountRules\BonusAmountForEachViewerAboveMinimumAudience(Amount::create(500), Audience::create(20)),
                new AmountRules\BonusAmountForEachViewer(Amount::create(300)),
            ]
    )
);
$amountCalculator->addAmountRules(
    Play\Type::create('tragedy'),
    new AmountRules(
        ... [
                new AmountRules\BaseAmountForPerformance(Amount::create(40000)),
                new AmountRules\BonusAmountForEachViewerAboveMinimumAudience(Amount::create(1000), Audience::create(30)),
            ]
    )
);
$creditVolumesCalculator = new CreditVolumesCalculator();
$creditVolumesCalculator->addCreditVolumesRules(
    Play\Type::create('comedy'),
    new CreditVolumesRules(
        ... [
            new Theatre\CreditVolumesRules\BonusCreditsForEachViewerAboveMinimumAudience(CreditVolumes::create(1), Audience::create(30)),
            new Theatre\CreditVolumesRules\BonusCreditVolumesForEachSpecifiedNumberOfViewers(CreditVolumes::create(1), Audience::create(5)),
        ]
    )
);
$creditVolumesCalculator->addCreditVolumesRules(
    Play\Type::create('tragedy'),
    new CreditVolumesRules(
        ... [
            new Theatre\CreditVolumesRules\BonusCreditsForEachViewerAboveMinimumAudience(CreditVolumes::create(1), Audience::create(30)),
        ]
    )
);
$plays = new Plays(...$plays);

foreach ($invoices as $invoice) {
    $performances = [];

    foreach ($invoice['performances'] as $performance) {
        $play     = $plays->find(Play\Id::create($performance['playId']));
        $audience = Audience::create($performance['audience']);

        $performances[] = new Performance($play, $audience);
    }

    $invoice = new Invoice(new Customer($invoice['customer']), new Performances(...$performances));


    echo statement($invoice, $plays, $amountCalculator, $creditVolumesCalculator) . PHP_EOL;
}