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

    public static function create(int $audience): Audience
    {
        return new self($audience);
    }

    public function value(): int
    {
        return $this->audience;
    }
}