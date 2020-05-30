<?php

namespace Theatre\Tests;

use InvalidArgumentException;
use Theatre\PlayId;
use PHPUnit\Framework\TestCase;

class PlayIdTest extends TestCase
{
    use Fixtures;

    public function testsPlayIdCannotBeTooLong(): void
    {
        $tooLongPlayId = $this->playIdValueTooLong();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('Length of id must be between %d-%d chars', 3, 15));

        PlayId::create($tooLongPlayId);
    }

    public function testsPlayIdCannotBeTooShort(): void
    {
        $tooShortPlayId = $this->playIdValueTooShort();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('Length of id must be between %d-%d chars', 3, 15));

        PlayId::create($tooShortPlayId);
    }

    public function testCreatedPlayIdContainsCorrectId(): void
    {
        $playIdValue = $this->playIdValue();

        $playId = PlayId::create($playIdValue);

        $this->assertSame($playIdValue, $playId->id());
    }
}
