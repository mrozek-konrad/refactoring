<?php

namespace Theatre\Tests;

use Theatre\AmountRule;
use Theatre\AmountRules;
use PHPUnit\Framework\TestCase;
use Theatre\Tests\Fixtures\AmountRulesFixtures;
use TypeError;

class AmountRulesTest extends TestCase
{
    use AmountRulesFixtures;

    public function testPerformancesCollectionCannotBeCreatedUsingObjectsOfTypeDifferentThanPerformance(): void
    {
        $invalidParams = $this->invalidAmountRulesParams();

        $this->expectException(TypeError::class);

        new AmountRules(...$invalidParams);
    }

    public function testPerformancesCollectionCanBeCreatedOnlyUsingObjectsOfPerformanceType(): void
    {
        $validParams = $this->validAmountRulesParams();

        $amountRules = new AmountRules(...$validParams);

        $this->assertSame($validParams, $amountRules->getArrayCopy());
        $this->assertSame(reset($validParams), $amountRules->current());
        $this->assertInstanceOf(AmountRule::class, $amountRules->current());
    }
}
