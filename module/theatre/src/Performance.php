<?php

declare(strict_types=1);

namespace Theatre;

use Theatre\Play\Id;

class Performance
{
    private Id   $playId;
    private Audience $audience;

    public function __construct(Id $playId, Audience $audience)
    {
        $this->playId   = $playId;
        $this->audience = $audience;
    }

    public function audience(): Audience
    {
        return $this->audience;
    }

    public function playId(): Id
    {
        return $this->playId;
    }
}