<?php

declare(strict_types=1);

namespace Theatre;

class Performance
{
    private Play     $play;
    private Audience $audience;

    public function __construct(Play $play, Audience $audience)
    {
        $this->audience = $audience;
        $this->play     = $play;
    }

    public function audience(): Audience
    {
        return $this->audience;
    }

    public function play(): Play
    {
        return $this->play;
    }
}
