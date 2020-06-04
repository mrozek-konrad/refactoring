<?php

declare(strict_types=1);

namespace Theatre\Tests\AmountRules;

use Theatre\AmountRule;
use Theatre\Tests\Fixtures\AmountRulesFixtures;
use Theatre\Tests\TheatreTestCase;

class BaseAmountForPerformanceTest extends TheatreTestCase
{
    use AmountRulesFixtures;

    public function testCalculatesCorrectResult(): void
    {
        $amountForPerformance = $this->amount();
        $audience             = $this->audience();

        $rule             = $this->buildBaseAmountForPerformanceRule($amountForPerformance);
        $calculatedAmount = $rule->calculateAmount($audience);

        $this->assertTrue($amountForPerformance->areEquals($calculatedAmount));
    }

    public function testIsTypeOfAmountRule(): void
    {
        $rule = $this->buildBaseAmountForPerformanceRule();

        $this->assertInstanceOf(AmountRule::class, $rule);
    }
}
