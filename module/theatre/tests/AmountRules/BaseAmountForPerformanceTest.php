<?php

namespace Theatre\Tests\AmountRules;

use PHPUnit\Framework\TestCase;
use Theatre\AmountRule;
use Theatre\Tests\Fixtures\AmountRulesFixtures;

class BaseAmountForPerformanceTest extends TestCase
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
