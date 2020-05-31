<?php

namespace Theatre\Tests\Play;

use InvalidArgumentException;
use Theatre\Play\Type;
use Theatre\Tests\Fixtures;
use Theatre\Tests\TheatreTestCase;

class TypeTest extends TheatreTestCase
{
    use Fixtures\PlayFixtures;

    public function testCreatedTypeContainsCorrectType(): void
    {
        $typeValue = $this->typeValue();

        $type = Type::create($typeValue);

        $this->assertSame($typeValue, $type->value());
    }

    public function testsTypeCannotBeTooLong(): void
    {
        $tooLongType = $this->typeValueTooLong();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('Length of type must be between %d-%d chars.', Type::LENGTH_MINIMUM, Type::LENGTH_MAXIMUM));

        Type::create($tooLongType);
    }

    public function testsTypeCannotBeTooShort(): void
    {
        $tooShortType = $this->typeValueTooShort();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('Length of type must be between %d-%d chars.', Type::LENGTH_MINIMUM, Type::LENGTH_MAXIMUM));

        Type::create($tooShortType);
    }
}
