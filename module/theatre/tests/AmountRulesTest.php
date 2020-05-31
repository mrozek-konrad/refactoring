<?php

namespace Theatre\Tests;

use Theatre\AmountRule;
use Theatre\AmountRules;
use Theatre\Tests\Fixtures\AmountRulesFixtures;
use TypeError;

class AmountRulesTest extends TheatreTestCase
{
    use AmountRulesFixtures;

    public function testPerformancesCollectionCanBeCreatedOnlyUsingObjectsOfPerformanceType(): void
    {
        $validParams = $this->validAmountRulesParams();

        $amountRules = new AmountRules(...$validParams);

        $this->assertSame($validParams, $amountRules->getArrayCopy());
        $this->assertSame(reset($validParams), $amountRules->current());
        $this->assertInstanceOf(AmountRule::class, $amountRules->current());
    }

    public function testPerformancesCollectionCannotBeCreatedUsingObjectsOfTypeDifferentThanPerformance(): void
    {
        $invalidParams = $this->invalidAmountRulesParams();

        $this->expectException(TypeError::class);

        new AmountRules(...$invalidParams);
    }
}
