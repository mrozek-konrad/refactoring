<?php

namespace Theatre\Tests;

use RuntimeException;
use Theatre\Amount;
use Theatre\AmountRule;
use Theatre\CreditVolumes;
use Theatre\CreditVolumesRule;
use Theatre\Tests\Fixtures\CreditVolumesCalculatorFixtures;

class CreditVolumesCalculatorTest extends TheatreTestCase
{
    use CreditVolumesCalculatorFixtures;

    public function testAllowToAddRulesForSomePlayType(): void
    {
        $creditVolumesCalculator = $this->creditVolumesCalculator();
        $creditVolumesRules      = $this->creditVolumesRules();
        $playType                = $this->playType();

        $creditVolumesCalculator->addCreditVolumesRules($playType, $creditVolumesRules);

        $this->assertSame($creditVolumesRules, $creditVolumesCalculator->creditVolumes($playType));
    }

    public function testDuringAmountCalculationUsesEveryAmountRuleProvidedForPlayType(): void
    {
        $performance             = $this->performance();
        $amountRuleProvider      = function () use ($performance): CreditVolumesRule {
            $rule = $this->createMock(CreditVolumesRule::class);
            $rule->expects($this->once())
                 ->method('calculateCredit')
                 ->with($performance->audience())
                 ->willReturn(CreditVolumes::zero());

            return $rule;
        };
        $creditVolumesRules      = $this->creditVolumesRules($amountRuleProvider);
        $creditVolumesCalculator = $this->creditVolumesCalculatorWithRulesForPlayType($performance->play()->type(), $creditVolumesRules);

        $creditVolumesCalculator->calculate($performance);
    }

    public function testResultOfCalculationIsCorrect(): void
    {
        $performance           = $this->performance();
        $ruleCalculationResult = $this->creditVolumes();

        $amountRuleProvider      = function () use ($performance, $ruleCalculationResult): CreditVolumesRule {
            $rule = $this->createMock(CreditVolumesRule::class);
            $rule->expects($this->once())
                 ->method('calculateCredit')
                 ->with($performance->audience())
                 ->willReturn($ruleCalculationResult);

            return $rule;
        };
        $creditVolumesRules      = $this->creditVolumesRules($amountRuleProvider);
        $creditVolumesCalculator = $this->creditVolumesCalculatorWithRulesForPlayType($performance->play()->type(), $creditVolumesRules);

        $expectedCalculatedAmount = CreditVolumes::create(count($creditVolumesRules) * $ruleCalculationResult->value());

        $calculatedAmount = $creditVolumesCalculator->calculate($performance);

        $this->assertTrue($expectedCalculatedAmount->areEquals($calculatedAmount));
    }

    public function testThrowsErrorIfRulesForPlayTypeDoesNotExist(): void
    {
        $creditVolumesCalculator = $this->creditVolumesCalculator();
        $playType                = $this->playType();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Credit volumes rules for play type ' . $playType->value() . ' are not set.');

        $creditVolumesCalculator->creditVolumes($playType);
    }
}
