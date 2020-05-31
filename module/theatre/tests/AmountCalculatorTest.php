<?php

namespace Theatre\Tests;

use RuntimeException;
use Theatre\Amount;
use Theatre\AmountRule;
use Theatre\Tests\Fixtures\AmountCalculatorFixtures;

class AmountCalculatorTest extends TheatreTestCase
{
    use AmountCalculatorFixtures;

    public function testAllowToAddRulesForSomePlayType(): void
    {
        $amountCalculator = $this->amountCalculator();
        $amountRules      = $this->amountRules();
        $playType         = $this->playType();

        $amountCalculator->addAmountRules($playType, $amountRules);

        $this->assertSame($amountRules, $amountCalculator->amountRules($playType));
    }

    public function testDuringAmountCalculationUsesEveryAmountRuleProvidedForPlayType(): void
    {
        $performance        = $this->performance();
        $amountRuleProvider = function () use ($performance): AmountRule {
            $rule = $this->createMock(AmountRule::class);
            $rule->expects($this->once())
                 ->method('calculateAmount')
                 ->with($performance->audience())
                 ->willReturn(Amount::zero());

            return $rule;
        };
        $amountRules        = $this->amountRules($amountRuleProvider);
        $amountCalculator   = $this->amountCalculatorWithRulesForPlayType($performance->play()->type(), $amountRules);

        $amountCalculator->calculate($performance);
    }

    public function testThrowsErrorIfRulesForPlayTypeDoesNotExist(): void
    {
        $amountCalculator = $this->amountCalculator();
        $playType         = $this->playType();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Amount rules for play ' . $playType->value() . ' are not set.');

        $amountCalculator->amountRules($playType);
    }
}
