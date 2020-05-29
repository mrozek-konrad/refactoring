<?php

declare(strict_types=1);

namespace Theatre;

use ArrayIterator;
use RuntimeException;

class Plays extends ArrayIterator
{
    public function __construct(Play ...$plays)
    {
        $this->assertPlaysOnlyWithUniqueId(...$plays);

        parent::__construct($plays);
    }

    public function current(): Play
    {
        return parent::current();
    }

    public function find(string $id): Play
    {
        $result = array_filter(
            $this->getArrayCopy(),
            function (Play $e) use ($id) {
                return $e->id() === $id;
            }
        );

        if (empty($result)) {
            throw new RuntimeException(sprintf('Play with id %s not found', $id));
        }

        return reset($result);
    }

    private function assertPlaysOnlyWithUniqueId(Play ...$plays): void
    {
        $ids = [];

        foreach ($plays as $play) {
            if (in_array($play->id(), $ids, true)) {
                throw new RuntimeException('Cannot add second play with id ' . $play->id());
            }

            $ids[] = $play->id();
        }
    }
}