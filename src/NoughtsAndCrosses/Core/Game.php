<?php

namespace NoughtsAndCrosses\Core;

class Game
{
    public static function createNew()
    {
        return new static();
    }

    public function getNewEvents()
    {
        return [
            new GameCreated()
        ];
    }
}
