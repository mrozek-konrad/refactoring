<?php

namespace Theatre\Tests\AmountRules;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Theatre\AmountRule;
use Theatre\AmountRules\AmountForAudienceAboveThanMinimumAudience;
use Theatre\Tests\Fixtures\AmountRulesFixtures;

class AmountForAudienceAboveMinimumAudienceTest extends TestCase
{
    use AmountRulesFixtures;

    public function testAmountMustBeAboveZero(): void
    {
        $amount = $this->amountLowerOrEqualsZero();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Amount must be above zero.');

        $this->buildAmountForAudienceAboveThanMinimumAudienceRule($amount);
    }

    public function testCalculatesCorrectResultIfAudienceIsAboveMinimum(): void
    {
        $minimumAudience                  = $this->audience();
        $audienceAboveThanMinimumAudience = $this->audienceAboveThan($minimumAudience);
        $amountIfAudienceIsAboveMinimum   = $this->amount();

        $rule             = $this->buildAmountForAudienceAboveThanMinimumAudienceRule($amountIfAudienceIsAboveMinimum, $minimumAudience);
        $calculatedAmount = $rule->calculateAmount($audienceAboveThanMinimumAudience);

        $this->assertSame($amountIfAudienceIsAboveMinimum, $calculatedAmount);
    }

    public function testCalculatesCorrectResultIfAudienceIsLowerThanMinimum(): void
    {
        $minimumAudience                  = $this->audience();
        $audienceLowerThanMinimumAudience = $this->audienceLowerThan($minimumAudience);
        $amountIfAudienceIsAboveMinimum   = $this->amount();

        $rule             = $this->buildAmountForAudienceAboveThanMinimumAudienceRule($amountIfAudienceIsAboveMinimum, $minimumAudience);
        $calculatedAmount = $rule->calculateAmount($audienceLowerThanMinimumAudience);

        $this->assertSame(AmountForAudienceAboveThanMinimumAudience::AMOUNT_IF_AUDIENCE_IS_LOWER_THAN_MINIMUM, $calculatedAmount);
    }

    public function testIsTypeOfAmountRule(): void
    {
        $rule = $this->buildAmountForAudienceAboveThanMinimumAudienceRule();

        $this->assertInstanceOf(AmountRule::class, $rule);
    }

    public function testMinimumAudienceMustBeAboveZero(): void
    {
        $minimumAudience = $this->audienceLowerOrEqualsZero();
        $amount          = $this->amount();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Minimum audience must be above zero.');

        $this->buildAmountForAudienceAboveThanMinimumAudienceRule($amount, $minimumAudience);
    }
}
