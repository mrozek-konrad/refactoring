<?php

declare(strict_types=1);

namespace Theatre;

use InvalidArgumentException;

class Play
{
    public const PARAM_ID   = 'id';
    public const PARAM_TYPE = 'type';
    public const PARAM_NAME = 'name';

    public const ID_LENGTH_MINIMUM = 2;
    public const ID_LENGTH_MAXIMUM = 20;

    public const NAME_LENGTH_MINIMUM = 3;
    public const NAME_LENGTH_MAXIMUM = 70;

    public const TYPE_LENGTH_MINIMUM = 5;
    public const TYPE_LENGTH_MAXIMUM = 15;

    private string $id;
    private string $name;
    private string $type;

    public function __construct(string $id, string $name, string $type)
    {
        $this->validateLength($id, self::PARAM_ID, self::ID_LENGTH_MINIMUM, self::ID_LENGTH_MAXIMUM);
        $this->validateLength($name, self::PARAM_NAME, self::NAME_LENGTH_MINIMUM, self::NAME_LENGTH_MAXIMUM);
        $this->validateLength($type, self::PARAM_TYPE, self::TYPE_LENGTH_MINIMUM, self::TYPE_LENGTH_MAXIMUM);

        $this->id   = $id;
        $this->name = $name;
        $this->type = $type;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): string
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