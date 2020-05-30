<?php

namespace Theatre\Tests\AmountRules;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Theatre\AmountRule;
use Theatre\AmountRules\BonusAmountForAudienceAboveThanMinimumAudience;
use Theatre\Tests\Fixtures\AmountRulesFixtures;

class BonusAmountForAudienceAboveMinimumAudienceTest extends TestCase
{
    use AmountRulesFixtures;

    public function testAmountMustBeAboveZero(): void
    {
        $amount = $this->amountLowerOrEqualsZero();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Bonus amount if audience is above than minimum must be above zero.');

        $this->buildBonusAmountForAudienceAboveThanMinimumAudienceRule($amount);
    }

    public function testCalculatesCorrectResultIfAudienceIsAboveMinimum(): void
    {
        $minimumAudience                     = $this->audience();
        $audienceAboveThanMinimumAudience    = $this->audienceAboveThan($minimumAudience);
        $bonusAmountIfAudienceIsAboveMinimum = $this->amount();

        $rule             = $this->buildBonusAmountForAudienceAboveThanMinimumAudienceRule($bonusAmountIfAudienceIsAboveMinimum, $minimumAudience);
        $calculatedAmount = $rule->calculateAmount($audienceAboveThanMinimumAudience);

        $this->assertSame($bonusAmountIfAudienceIsAboveMinimum, $calculatedAmount);
    }

    public function testCalculatesCorrectResultIfAudienceIsLowerThanMinimum(): void
    {
        $minimumAudience                     = $this->audience();
        $audienceLowerThanMinimumAudience    = $this->audienceLowerThan($minimumAudience);
        $bonusAmountIfAudienceIsAboveMinimum = $this->amount();

        $rule             = $this->buildBonusAmountForAudienceAboveThanMinimumAudienceRule($bonusAmountIfAudienceIsAboveMinimum, $minimumAudience);
        $calculatedAmount = $rule->calculateAmount($audienceLowerThanMinimumAudience);

        $this->assertSame(BonusAmountForAudienceAboveThanMinimumAudience::BONUS_AMOUNT_IF_AUDIENCE_IS_LOWER_THAN_MINIMUM, $calculatedAmount);
    }

    public function testIsTypeOfAmountRule(): void
    {
        $rule = $this->buildBonusAmountForAudienceAboveThanMinimumAudienceRule();

        $this->assertInstanceOf(AmountRule::class, $rule);
    }

    public function testMinimumAudienceMustBeAboveZero(): void
    {
        $minimumAudience = $this->audienceLowerOrEqualsZero();
        $amount          = $this->amount();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Minimum audience must be above zero.');

        $this->buildBonusAmountForAudienceAboveThanMinimumAudienceRule($amount, $minimumAudience);
    }
}
