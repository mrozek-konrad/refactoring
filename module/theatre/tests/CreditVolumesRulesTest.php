<?php

namespace Theatre\Tests;

use Theatre\CreditVolumesRule;
use Theatre\CreditVolumesRules;
use Theatre\Tests\Fixtures\CreditVolumesRulesFixtures;
use TypeError;

class CreditVolumesRulesTest extends TheatreTestCase
{
    use CreditVolumesRulesFixtures;

    public function testPerformancesCollectionCanBeCreatedOnlyUsingObjectsOfPerformanceType(): void
    {
        $validParams = $this->validCreditVolumesParams();

        $amountRules = new CreditVolumesRules(...$validParams);

        $this->assertSame($validParams, $amountRules->getArrayCopy());
        $this->assertSame(reset($validParams), $amountRules->current());
        $this->assertInstanceOf(CreditVolumesRule::class, $amountRules->current());
    }

    public function testPerformancesCollectionCannotBeCreatedUsingObjectsOfTypeDifferentThanPerformance(): void
    {
        $invalidParams = $this->invalidCreditVolumesParams();

        $this->expectException(TypeError::class);

        new CreditVolumesRules(...$invalidParams);
    }
}
