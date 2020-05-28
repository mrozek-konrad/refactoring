<?php

declare(strict_types=1);

namespace Theatre;

use InvalidArgumentException;

class Customer
{
    private const NAME_LENGTH_MINIMUM = 3;
    private const NAME_LENGTH_MAXIMUM = 30;

    private string $name;

    public function __construct(string $name)
    {
        $length = strlen($name);

        if ($length >= self::NAME_LENGTH_MINIMUM && $length <= self::NAME_LENGTH_MAXIMUM) {
            throw new InvalidArgumentException(
                printf('Length of name must be between %d-%d chars.', self::NAME_LENGTH_MINIMUM, self::NAME_LENGTH_MAXIMUM)
            );
        }

        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }
}