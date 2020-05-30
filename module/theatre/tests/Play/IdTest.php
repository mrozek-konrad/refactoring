<?php

namespace Theatre\Tests\Play;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Theatre\Play\Id;
use Theatre\Tests\Fixtures;

class IdTest extends TestCase
{
    use Fixtures;

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
        $this->expectExceptionMessage(sprintf('Length of id must be between %d-%d chars', 3, 15));

        Id::create($tooLongPlayId);
    }

    public function testsPlayIdCannotBeTooShort(): void
    {
        $tooShortPlayId = $this->playIdValueTooShort();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('Length of id must be between %d-%d chars', 3, 15));

        Id::create($tooShortPlayId);
    }
}
