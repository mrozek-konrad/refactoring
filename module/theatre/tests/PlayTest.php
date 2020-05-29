<?php

namespace Theatre\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Theatre\Play;

class PlayTest extends TestCase
{
    use Fixtures;

    public function testPlayIdCannotBeTooLong(): void
    {
        $id   = $this->playIdTooLong();
        $name = $this->playName();
        $type = $this->playType();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of %s must be between %d-%d chars.', Play::PARAM_ID, Play::ID_LENGTH_MINIMUM, Play::ID_LENGTH_MAXIMUM)
        );

        new Play($id, $name, $type);
    }

    public function testPlayIdCannotBeTooShort(): void
    {
        $id   = $this->playIdTooShort();
        $name = $this->playName();
        $type = $this->playType();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of %s must be between %d-%d chars.', Play::PARAM_ID, Play::ID_LENGTH_MINIMUM, Play::ID_LENGTH_MAXIMUM)
        );

        new Play($id, $name, $type);
    }

    public function testPlayNameCannotBeTooLong(): void
    {
        $id   = $this->playId();
        $name = $this->playNameTooLong();
        $type = $this->playType();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of %s must be between %d-%d chars.', Play::PARAM_NAME, Play::NAME_LENGTH_MINIMUM, Play::NAME_LENGTH_MAXIMUM)
        );

        new Play($id, $name, $type);
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

        new Play($id, $name, $type);
    }

    public function testPlayReturnsValidIdAndNameAndType(): void
    {
        $id   = $this->playId();
        $name = $this->playName();
        $type = $this->playType();

        $play = new Play($id, $name, $type);

        $this->assertSame($id, $play->id());
        $this->assertSame($name, $play->name());
        $this->assertSame($type, $play->type());
    }

    public function testPlayTypeCannotBeTooLong(): void
    {
        $id   = $this->playId();
        $name = $this->playName();
        $type = $this->playTypeTooLong();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of %s must be between %d-%d chars.', Play::PARAM_TYPE, Play::TYPE_LENGTH_MINIMUM, Play::TYPE_LENGTH_MAXIMUM)
        );

        new Play($id, $name, $type);
    }

    public function testPlayTypeCannotBeTooShort(): void
    {
        $id   = $this->playId();
        $name = $this->playName();
        $type = $this->playTypeTooShort();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of %s must be between %d-%d chars.', Play::PARAM_TYPE, Play::TYPE_LENGTH_MINIMUM, Play::TYPE_LENGTH_MAXIMUM)
        );

        new Play($id, $name, $type);
    }
}
