<?php

namespace Theatre\Tests;

use InvalidArgumentException;
use Theatre\Play;
use Theatre\Tests\Fixtures\PlayFixtures;

class PlayTest extends TheatreTestCase
{
    use PlayFixtures;

    public function testPlayNameCannotBeTooLong(): void
    {
        $id   = $this->playId();
        $name = $this->playNameTooLong();
        $type = $this->playType();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of %s must be between %d-%d chars.', Play::PARAM_NAME, Play::NAME_LENGTH_MINIMUM, Play::NAME_LENGTH_MAXIMUM)
        );

        Play::create($id, $name, $type);
    }

    public function testPlayNameCannotBeTooShort(): void
    {
        $id   = $this->playId();
        $name = $this->playNameTooShort();
        $type = $this->playType();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of %s must be between %d-%d chars.', Play::PARAM_NAME, Play::NAME_LENGTH_MINIMUM, Play::NAME_LENGTH_MAXIMUM)
        );

        Play::create($id, $name, $type);
    }

    public function testPlayReturnsValidIdAndNameAndType(): void
    {
        $id   = $this->playId();
        $name = $this->playName();
        $type = $this->playType();

        $play = Play::create($id, $name, $type);

        $this->assertSame($id, $play->id());
        $this->assertSame($name, $play->name());
        $this->assertSame($type, $play->type());
    }
}
