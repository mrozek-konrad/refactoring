<?php

declare(strict_types=1);

namespace Theatre\Play;

use InvalidArgumentException;

class Type
{
    public const LENGTH_MINIMUM = 5;
    public const LENGTH_MAXIMUM = 25;

    private string $type;

    public function __construct(string $type)
    {
        $lengthPlayId = strlen($type);

        if ($lengthPlayId < self::LENGTH_MINIMUM || $lengthPlayId > self::LENGTH_MAXIMUM) {
            throw new InvalidArgumentException(sprintf('Length of type must be between %d-%d chars.', self::LENGTH_MINIMUM, self::LENGTH_MAXIMUM));
        }

        $this->type = $type;
    }

    public static function create(string $type): Type
    {
        return new self($type);
    }

    public function value(): string
    {
        return $this->type;
    }
}