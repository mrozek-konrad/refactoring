<?php

declare(strict_types=1);

namespace Theatre\Tests\CreditVolumesRules;

use Theatre\CreditVolumes;
use Theatre\CreditVolumesRule;
use Theatre\Tests\Fixtures\CreditVolumesRulesFixtures;
use Theatre\Tests\TheatreTestCase;

class BonusCreditVolumesForEachSpecifiedNumberOfViewersTest extends TheatreTestCase
{
    use CreditVolumesRulesFixtures;

    public function testCalculatesCorrectCreditVolumesIfAudienceIsAboveMinimumPartOfPrizedAudience(): void
    {
        $creditVolumesForEachPartOfAudience = $this->creditVolumes();
        $partOfAudienceWhichWillBePrized    = $this->audience();
        $audience                           = $this->audienceAboveThan($partOfAudienceWhichWillBePrized);

        $expectedBonusCreditVolumes = $creditVolumesForEachPartOfAudience->multiply(
            (int) floor($audience->value() / $partOfAudienceWhichWillBePrized->value()) ?? 0
        );

        $rule             = $this->buildBonusCreditVolumesForEachSpecifiedNumberOfViewersRule(
            $creditVolumesForEachPartOfAudience,
            $partOfAudienceWhichWillBePrized
        );
        $calculatedAmount = $rule->calculateCredit($audience);

        $this->assertTrue($expectedBonusCreditVolumes->areEquals($calculatedAmount));
    }

    public function testCalculatesCorrectCreditVolumesIfAudienceIsLowerMinimumPartOfPrizedAudience(): void
    {
        $creditVolumesForEachPartOfAudience = $this->creditVolumes();
        $partOfAudienceWhichWillBePrized    = $this->audience();
        $audience                           = $this->audienceLowerThan($partOfAudienceWhichWillBePrized);

        $expectedBonusCreditVolumes = CreditVolumes::zero();

        $rule             = $this->buildBonusCreditVolumesForEachSpecifiedNumberOfViewersRule(
            $creditVolumesForEachPartOfAudience,
            $partOfAudienceWhichWillBePrized
        );
        $calculatedAmount = $rule->calculateCredit($audience);

        $this->assertTrue($expectedBonusCreditVolumes->areEquals($calculatedAmount));
    }

    public function testIsTypeOfAmountRule(): void
    {
        $rule = $this->buildBonusCreditVolumesForEachSpecifiedNumberOfViewersRule();

        $this->assertInstanceOf(CreditVolumesRule::class, $rule);
    }
}
