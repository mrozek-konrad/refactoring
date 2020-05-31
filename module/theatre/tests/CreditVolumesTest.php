<?php

namespace Theatre\Tests;

use InvalidArgumentException;
use Theatre\CreditVolumes;
use Theatre\Tests\Fixtures\CreditVolumesFixtures;

class CreditVolumesTest extends TheatreTestCase
{
    use CreditVolumesFixtures;

    public function testCreditVolumesCanBeAddedToOtherCreditVolumes(): void
    {
        $someCreditVolumesValue  = $this->creditVolumesValue();
        $otherCreditVolumesValue = $this->creditVolumesValueGreaterThan($someCreditVolumesValue);

        $firstCreditValues  = $this->creditVolumes($someCreditVolumesValue);
        $secondCreditValues = $this->creditVolumes($someCreditVolumesValue);

        $creditVolumesWithDifferentValue = $this->creditVolumes($otherCreditVolumesValue);

        $this->assertTrue($firstCreditValues->areEquals($secondCreditValues));
        $this->assertTrue($secondCreditValues->areEquals($firstCreditValues));

        $this->assertFalse($firstCreditValues->areEquals($creditVolumesWithDifferentValue));
        $this->assertFalse($secondCreditValues->areEquals($creditVolumesWithDifferentValue));
    }

    public function testCreditVolumesCanBeComparedToOtherCreditVolumes(): void
    {
        $firstCreditValue  = $this->creditVolumes();
        $secondCreditValue = $this->creditVolumes();

        $resultCredit = $firstCreditValue->add($secondCreditValue);

        $this->assertSame($resultCredit->value(), $firstCreditValue->value() + $secondCreditValue->value());
    }

    public function testCreditVolumesCannotBeLessThanZero(): void
    {
        $creditValueLessThanZero = $this->creditVolumesValueLessThanZero();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Credit volumes cannot be less than zero');

        CreditVolumes::create($creditValueLessThanZero);
    }

    public function testCreditVolumesZeroMethodCreatesCreditVolumesWithZeroValue(): void
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
