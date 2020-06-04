<?php

declare(strict_types=1);

namespace Theatre;

use InvalidArgumentException;

class Audience
{
    private int $audience;

    public function __construct(int $audience)
    {
        if ($audience < 0) {
            throw new InvalidArgumentException('Audience must be greater than zero');
        }

        $this->audience = $audience;
    }

    public static function create(int $audience): self
    {
        return new self($audience);
    }

    public function isLessThan(self $minimumAudience): bool
    {
        return $this->audience < $minimumAudience->value();
    }

    public function minus(self $audience): self
    {
        return self::create(max($this->audience - $audience->value(), 0));
    }

    public function value(): int
    {
        return $this->audience;
    }
}
