<?php

namespace Theatre\Tests;

use InvalidArgumentException;
use Theatre\Amount;
use Theatre\Tests\Fixtures\AmountFixtures;

class AmountTest extends TheatreTestCase
{
    use AmountFixtures;

    public function testAmountCanBeAddedToOtherAmount(): void
    {
        $firstAmountValue  = $this->amount();
        $secondAmountValue = $this->amount();

        $resultAmount = $firstAmountValue->add($secondAmountValue);

        $this->assertSame($resultAmount->value(), $firstAmountValue->value() + $secondAmountValue->value());
    }

    public function testAmountCanBeMultipliedBySomeValue(): void
    {
        $amount     = $this->amount();
        $multiplyBy = $this->tinyValue();

        $resultAmount = $amount->multiply($multiplyBy);

        $this->assertSame($resultAmount->value(), $amount->value() * $multiplyBy);
    }

    public function testAmountCannotBeLessThanZero(): void
    {
        $amountValueLessThanZero = $this->amountValueLessThanZero();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Amount cannot be less than zero');

        Amount::create($amountValueLessThanZero);
    }

    public function testAmountZeroMethodCreatesAmountWithZeroValue(): void
    {
        $amount = Amount::zero();

        $this->assertSame(0, $amount->value());
    }

    public function testReturnsCorrectResponseWhenIsEqualToOtherAmount(): void
    {
        $amountValue = $this->amountValue();
        $amount      = Amount::create($amountValue);
        $otherAmount = Amount::create($amountValue);

        $this->assertSame(false, $amount->isLessThan($otherAmount));
        $this->assertSame(false, $amount->isGreaterThan($otherAmount));
    }

    public function testReturnsCorrectResponseWhenIsGreaterThanOtherAmount(): void
    {
        $amountValue = $this->amountValue();
        $amount      = Amount::create($amountValue);

        $lessAmountValue = $this->amountValueLessThan($amountValue);
        $lessAmount      = Amount::create($lessAmountValue);

        $this->assertSame(true, $amount->isGreaterThan($lessAmount));
    }

    public function testReturnsCorrectResponseWhenIsLessThanOtherAmount(): void
    {
        $amountValue = $this->amountValue();
        $amount      = Amount::create($amountValue);

        $greaterAmountValue = $this->amountValueGreaterThan($amountValue);
        $greaterAmount      = Amount::create($greaterAmountValue);

        $this->assertSame(true, $amount->isLessThan($greaterAmount));
    }

    public function testReturnsValidAmountValue(): void
    {
        $amountValue = $this->amountValue();

        $amount = Amount::create($amountValue);

        $this->assertSame($amountValue, $amount->value());
    }
}
