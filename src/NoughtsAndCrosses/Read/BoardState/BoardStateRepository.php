<?php

namespace NoughtsAndCrosses\Read\BoardState;

use NoughtsAndCrosses\Core\GameId;

interface BoardStateRepository
{
    public function find(GameId $id);

    public function add(GameId $id, BoardState $boardState);
}
