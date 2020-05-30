<?php

declare(strict_types=1);

namespace Theatre;

use InvalidArgumentException;

class PlayId
{
    private string $id;

    public function __construct(string $id)
    {
        $lengthPlayId = strlen($id);

        if ($lengthPlayId < 3 || $lengthPlayId > 15) {
            throw new InvalidArgumentException(sprintf('Length of id must be between %d-%d chars.', 3, 15));
        }

        $this->id = $id;
    }

    public static function create(string $id): PlayId
    {
        return new self($id);
    }

    public function id(): string
    {
        return $this->id;
    }
}