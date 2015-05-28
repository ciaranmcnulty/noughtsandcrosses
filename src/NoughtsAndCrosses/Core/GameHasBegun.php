<?php

namespace NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Event\Event;

class GameHasBegun implements Event
{
    private $id;

    public function __construct(GameIdentity $id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }
}
