<?php

declare(strict_types=1);

namespace Theatre\Play;

use InvalidArgumentException;

class Name
{
    public const LENGTH_MINIMUM = 3;
    public const LENGTH_MAXIMUM = 75;

    private string $name;

    public function __construct(string $name)
    {
        $lengthPlayId = strlen($name);

        if ($lengthPlayId < self::LENGTH_MINIMUM || $lengthPlayId > self::LENGTH_MAXIMUM) {
            throw new InvalidArgumentException(sprintf('Length of name must be between %d-%d chars.', self::LENGTH_MINIMUM, self::LENGTH_MAXIMUM));
        }

        $this->name = $name;
    }

    public static function create(string $name): Name
    {
        return new self($name);
    }

    public function value(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}