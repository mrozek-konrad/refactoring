<?php

namespace Theatre\Tests;

use InvalidArgumentException;
use Theatre\Credit;
use Theatre\Tests\Fixtures\CreditFixtures;

class CreditTest extends TheatreTestCase
{
    use CreditFixtures;

    public function testCreditCanBeAddedToOtherCredit(): void
    {
        $firstCreditValue  = $this->credit();
        $secondCreditValue = $this->credit();

        $resultCredit = $firstCreditValue->add($secondCreditValue);

        $this->assertSame($resultCredit->value(), $firstCreditValue->value() + $secondCreditValue->value());
    }

    public function testCreditCannotBeLessThanZero(): void
    {
        $creditValueLessThanZero = $this->creditValueLessThanZero();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Credit cannot be less than zero');

        Credit::create($creditValueLessThanZero);
    }

    public function testCreditZeroMethodCreatesCreditWithZeroValue(): void
    {
        $credit = Credit::zero();

        $this->assertSame(0, $credit->value());
    }

    public function testReturnsValidCreditValue(): void
    {
        $creditValue = $this->creditValue();

        $credit = Credit::create($creditValue);

        $this->assertSame($creditValue, $credit->value());
    }
}
