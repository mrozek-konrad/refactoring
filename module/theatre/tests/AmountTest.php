<?php

namespace Theatre\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Theatre\Amount;
use Theatre\Tests\Fixtures\AmountRulesFixtures;

class AmountTest extends TestCase
{
    use AmountRulesFixtures;

    public function testAmountMustBeAboveZero(): void
    {
        $amountLowerOrEqualZero = $this->amountValueLowerOrEqualZero();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Amount must be above zero.');

        new Amount($amountLowerOrEqualZero);
    }

    public function testReturnsCorrectResponseWhenIsEqualToOtherAmount(): void
    {
        $amountValue = $this->amountValue();
        $amount      = new Amount($amountValue);
        $otherAmount = new Amount($amountValue);

        $this->assertSame(false, $amount->isLessThan($otherAmount));
        $this->assertSame(false, $amount->isGreaterThan($otherAmount));
    }

    public function testReturnsCorrectResponseWhenIsGreaterThanOtherAmount(): void
    {
        $amountValue = $this->amountValue();
        $amount      = new Amount($amountValue);

        $lessAmountValue = $this->amountValueLessThan($amountValue);
        $lessAmount      = new Amount($lessAmountValue);

        $this->assertSame(true, $amount->isGreaterThan($lessAmount));
    }

    public function testReturnsCorrectResponseWhenIsLessThanOtherAmount(): void
    {
        $amountValue = $this->amountValue();
        $amount      = new Amount($amountValue);

        $greaterAmountValue = $this->amountValueGreaterThan($amountValue);
        $greaterAmount      = new Amount($greaterAmountValue);

        $this->assertSame(true, $amount->isLessThan($greaterAmount));
    }

    public function testReturnsValidAmountValue(): void
    {
        $amountValue = $this->amountValue();

        $amount = new Amount($amountValue);

        $this->assertSame($amountValue, $amount->amount());
    }
}
