<?php

declare(strict_types=1);

namespace Theatre\Tests\Play;

use InvalidArgumentException;
use Theatre\Play\Name;
use Theatre\Tests\Fixtures;
use Theatre\Tests\TheatreTestCase;

class NameTest extends TheatreTestCase
{
    use Fixtures\PlayFixtures;

    public function testCreatedNameContainsCorrectName(): void
    {
        $nameValue = $this->nameValue();

        $name = Name::create($nameValue);

        $this->assertSame($nameValue, $name->value());
    }

    public function testsNameCannotBeTooLong(): void
    {
        $tooLongName = $this->nameValueTooLong();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('Length of name must be between %d-%d chars.', Name::LENGTH_MINIMUM, Name::LENGTH_MAXIMUM));

        Name::create($tooLongName);
    }

    public function testsNameCannotBeTooShort(): void
    {
        $tooShortName = $this->nameValueTooShort();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('Length of name must be between %d-%d chars.', Name::LENGTH_MINIMUM, Name::LENGTH_MAXIMUM));

        Name::create($tooShortName);
    }
}
