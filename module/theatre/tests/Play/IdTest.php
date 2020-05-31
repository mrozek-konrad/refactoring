<?php

namespace Theatre\Tests\Play;

use InvalidArgumentException;
use Theatre\Play\Id;
use Theatre\Tests\Fixtures\PlayFixtures;
use Theatre\Tests\TheatreTestCase;

class IdTest extends TheatreTestCase
{
    use PlayFixtures;

    public function testCreatedPlayIdCanBeComparedWithOtherPlayId(): void
    {
        $playIdValue = $this->playIdValue();

        $playId      = Id::create($playIdValue);
        $otherPlayId = Id::create($playIdValue);

        $differentPlayId = $this->playId();

        $areEquals    = $playId->areEquals($otherPlayId);
        $areNotEquals = $playId->areEquals($differentPlayId);

        $this->assertTrue($areEquals);
        $this->assertFalse($areNotEquals);
    }

    public function testCreatedPlayIdContainsCorrectId(): void
    {
        $playIdValue = $this->playIdValue();

        $playId = Id::create($playIdValue);

        $this->assertSame($playIdValue, $playId->value());
    }

    public function testsPlayIdCannotBeTooLong(): void
    {
        $tooLongPlayId = $this->playIdValueTooLong();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('Length of id must be between %d-%d chars', Id::LENGTH_MINIMUM, Id::LENGTH_MAXIMUM));

        Id::create($tooLongPlayId);
    }

    public function testsPlayIdCannotBeTooShort(): void
    {
        $tooShortPlayId = $this->playIdValueTooShort();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('Length of id must be between %d-%d chars', Id::LENGTH_MINIMUM, Id::LENGTH_MAXIMUM));

        Id::create($tooShortPlayId);
    }
}
