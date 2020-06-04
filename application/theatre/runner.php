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
use Theatre\InvoiceCreator;
use Theatre\InvoicePrinter;
use Theatre\Performance;
use Theatre\Performances;
use Theatre\PerformancesSummaryCreator;
use Theatre\Play;
use Theatre\Plays;

function statement(Customer $customer, Performances $performances, InvoiceCreator $invoiceCreator, InvoicePrinter $invoicePrinter): string
{
    $invoice = $invoiceCreator->create($customer, $performances);

    return $invoicePrinter->print($invoice);
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

$performanceSummaryCreator = new PerformancesSummaryCreator($amountCalculator, $creditVolumesCalculator);

$invoiceCreator = new InvoiceCreator($performanceSummaryCreator);
$invoicePrinter = new InvoicePrinter();

foreach ($invoices as $invoice) {
    $performances = [];

    foreach ($invoice['performances'] as $performance) {
        $play     = $plays->find(Play\Id::create($performance['playId']));
        $audience = Audience::create($performance['audience']);

        $performances[] = new Performance($play, $audience);
    }

    $customer     = new Customer($invoice['customer']);
    $performances = new Performances(...$performances);

    echo statement($customer, $performances, $invoiceCreator, $invoicePrinter) . PHP_EOL;
}