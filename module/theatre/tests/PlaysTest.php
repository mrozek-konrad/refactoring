<?php

namespace Theatre\Tests;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use Theatre\Play;
use Theatre\Plays;
use TypeError;

class PlaysTest extends TestCase
{
    use Fixtures;

    public function testAllowToFindPlayWithSpecifiedId(): void
    {
        $playId = $this->playId();
        $play   = $this->play($playId);
        $plays  = $this->playsWithPlay($play);

        $foundPlay = $plays->find($playId);

        $this->assertSame($play, $foundPlay);
    }

    public function testCannotAddToCollectionTwoPlaysWithTheSameId(): void
    {
        $playId        = $this->playId();
        $invalidParams = $this->invalidPlayParamsWithFewPlaysWithTheSameId($playId);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Cannot add second play with id ' . $playId->value());

        new Plays(...$invalidParams);
    }

    public function testPlaysCollectionCanBeCreatedOnlyUsingObjectsOfPlayType(): void
    {
        $validParams = $this->validPlayParams();

        $plays = new Plays(...$validParams);

        $this->assertSame($validParams, $plays->getArrayCopy());
        $this->assertSame(reset($validParams), $plays->current());
        $this->assertInstanceOf(Play::class, $plays->current());
    }

    public function testPlaysCollectionCannotBeCreatedUsingObjectsOfTypeDifferentThanPlay(): void
    {
        $invalidParams = $this->invalidPlayParams();

        $this->expectException(TypeError::class);

        new Plays(...$invalidParams);
    }

    public function testThrowsErrorWhenYouFindingPlayWhichDoesNotExistInPlays(): void
    {
        $plays  = $this->plays([$this->play(), $this->play()]);
        $somePlayId = $this->playId();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(sprintf('Play with id %s not found', $somePlayId->value()));

        $plays->find($somePlayId);
    }
}
