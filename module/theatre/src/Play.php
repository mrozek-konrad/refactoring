<?php

declare(strict_types=1);

namespace Theatre;

use Theatre\Play\Id;
use Theatre\Play\Name;
use Theatre\Play\Type;

class Play
{
    private Id     $id;
    private Name $name;
    private Type   $type;

    public function __construct(Id $id, Name $name, Type $type)
    {
        $this->id   = $id;
        $this->name = $name;
        $this->type = $type;
    }

    public static function create(Id $id, Name $name, Type $type): self
    {
        return new self($id, $name, $type);
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function type(): Type
    {
        return $this->type;
    }
}
