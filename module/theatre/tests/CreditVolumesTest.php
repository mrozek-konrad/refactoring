<?php

namespace Theatre\Tests;

use InvalidArgumentException;
use Theatre\CreditVolumes;
use Theatre\Tests\Fixtures\CreditVolumesFixtures;

class CreditVolumesTest extends TheatreTestCase
{
    use CreditVolumesFixtures;

    public function testCreditCanBeAddedToOtherCredit(): void
    {
        $firstCreditValue  = $this->creditVolumes();
        $secondCreditValue = $this->creditVolumes();

        $resultCredit = $firstCreditValue->add($secondCreditValue);

        $this->assertSame($resultCredit->value(), $firstCreditValue->value() + $secondCreditValue->value());
    }

    public function testCreditCannotBeLessThanZero(): void
    {
        $creditValueLessThanZero = $this->creditVolumesValueLessThanZero();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Credit cannot be less than zero');

        CreditVolumes::create($creditValueLessThanZero);
    }

    public function testCreditZeroMethodCreatesCreditWithZeroValue(): void
    {
        $credit = CreditVolumes::zero();

        $this->assertSame(0, $credit->value());
    }

    public function testReturnsValidCreditValue(): void
    {
        $creditValue = $this->creditVolumesValue();

        $credit = CreditVolumes::create($creditValue);

        $this->assertSame($creditValue, $credit->value());
    }
}
