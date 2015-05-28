<?php

namespace NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Event\Event;

class Game
{
    private $events = [];

    private $id;

    private $occupiedSquares = [];

    private $lastPlayer;

    private function __construct(){}

    public static function begin(GameId $identity)
    {
        $game = new static();
        $game->apply(new GameBegan($identity));

        return $game;
    }

    public static function fromEvents(array $events)
    {
        $game = new static();

        foreach ($events as $event) {
            $game->apply($event);
        }

        $game->events = [];

        return $game;
    }

    public function getNewEvents()
    {
        return $this->events;
    }

    public function play(Square $square, Player $player)
    {
        $this->apply(new MoveTaken($this->id, $square, $player));
    }

    private function apply(Event $event)
    {
        if ($event instanceof GameBegan) {
            $this->applyGameBegan($event);
        }
        elseif ($event instanceof MoveTaken) {
            $this->applyMoveTaken($event);
        }

        $this->events[] = $event;
    }

    private function applyGameBegan(GameBegan $gameBegan)
    {
        $this->id = $gameBegan->id();
    }

    private function applyMoveTaken(MoveTaken $moveTaken)
    {
        if (in_array($moveTaken->square(), $this->occupiedSquares)) {
            throw new MoveNotValid('Square already played');
        }

        if ($moveTaken->player() == $this->lastPlayer) {
            throw new MoveNotValid('Same player played twice in a row');
        }

        $this->lastPlayer = $moveTaken->player();
        $this->occupiedSquares[] = $moveTaken->square();
    }
}
