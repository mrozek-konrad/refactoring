<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\Audience;

trait AudienceFixtures
{
    use RandomScalarValuesFixtures;

    final protected function audience(): Audience
    {
        return Audience::create($this->smallValue());
    }

    final protected function audienceAboveThan(Audience $audience): Audience
    {
        return Audience::create(
            $this->value($audience->value() + $this->one(), $this->mediumValue())
        );
    }

    final protected function audienceLowerThan(Audience $audience): Audience
    {
        return Audience::create(
            $this->value($this->one(), $audience->value() - $this->one())
        );
    }

    final protected function audienceValue(): int
    {
        return $this->value($this->one(), $this->smallValue());
    }

    final protected function audienceValueLowerOrEqualsZero(): int
    {
        return $this->value(-$this->mediumValue(), $this->zero());
    }
}
