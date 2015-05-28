<?php

namespace NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Command\Command;

class BeginGame implements Command
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
