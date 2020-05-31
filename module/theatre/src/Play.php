<?php

declare(strict_types=1);

namespace Theatre;

use InvalidArgumentException;
use Theatre\Play\Id;
use Theatre\Play\Type;

class Play
{
    public const PARAM_NAME = 'name';

    public const NAME_LENGTH_MINIMUM = 3;
    public const NAME_LENGTH_MAXIMUM = 70;

    private Id     $id;
    private string $name;
    private Type   $type;

    public function __construct(Id $id, string $name, Type $type)
    {
        $this->validateLength($name, self::PARAM_NAME, self::NAME_LENGTH_MINIMUM, self::NAME_LENGTH_MAXIMUM);

        $this->id   = $id;
        $this->name = $name;
        $this->type = $type;
    }

    public static function create(Id $id, string $name, Type $type): Play
    {
        return new self($id, $name, $type);
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): Type
    {
        return $this->type;
    }

    private function validateLength(string $paramValue, string $paramName, int $min, int $max): void
    {
        $length = strlen($paramValue);

        if ($length < $min || $length > $max) {
            throw new InvalidArgumentException(
                sprintf('Length of %s must be between %d-%d chars.', $paramName, $min, $max)
            );
        }
    }
}