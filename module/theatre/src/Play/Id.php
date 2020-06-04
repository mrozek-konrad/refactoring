<?php

declare(strict_types=1);

namespace Theatre\Play;

use InvalidArgumentException;

class Id
{
    public const LENGTH_MINIMUM = 5;
    public const LENGTH_MAXIMUM = 25;

    private string $id;

    public function __construct(string $id)
    {
        $lengthPlayId = strlen($id);

        if ($lengthPlayId < self::LENGTH_MINIMUM || $lengthPlayId > self::LENGTH_MAXIMUM) {
            throw new InvalidArgumentException(sprintf('Length of id must be between %d-%d chars.', self::LENGTH_MINIMUM, self::LENGTH_MAXIMUM));
        }

        $this->id = $id;
    }

    public static function create(string $id): self
    {
        return new self($id);
    }

    public function areEquals(self $id): bool
    {
        return $this->id === $id->value();
    }

    public function value(): string
    {
        return $this->id;
    }
}
