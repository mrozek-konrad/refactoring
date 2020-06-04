<?php

declare(strict_types=1);

namespace Theatre\Tests;

use Theatre\Play;
use Theatre\Tests\Fixtures\PlayFixtures;

class PlayTest extends TheatreTestCase
{
    use PlayFixtures;

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
