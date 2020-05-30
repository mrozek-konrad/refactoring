<?php

namespace Theatre\Tests\AmountRules;

use PHPUnit\Framework\TestCase;
use Theatre\AmountRule;
use Theatre\Tests\Fixtures\AmountRulesFixtures;

class BonusAmountForEachViewerTest extends TestCase
{
    use AmountRulesFixtures;

    public function testCalculatesCorrectResult(): void
    {
        $bonusAmountForEachViewer = $this->amount();
        $audience                 = $this->audience();

        $expectedBonusAmount = $bonusAmountForEachViewer->multiply($audience->value());

        $rule             = $this->buildBonusAmountForEachViewerRule($bonusAmountForEachViewer);
        $calculatedAmount = $rule->calculateAmount($audience);

        $this->assertTrue($expectedBonusAmount->areEquals($calculatedAmount));
    }

    public function testIsTypeOfAmountRule(): void
    {
        $rule = $this->buildBonusAmountForEachViewerRule();

        $this->assertInstanceOf(AmountRule::class, $rule);
    }
}
