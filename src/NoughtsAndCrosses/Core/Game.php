<?php

namespace NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Event\Event;

class Game
{
    private $events = [];

    private $id;

    private $occupiedSquares = [];

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
            $this->id = $event->id();
        }
        elseif ($event instanceof MoveTaken) {
            if (in_array($event->square(), $this->occupiedSquares)) {
                throw new MoveNotValid('Square already played');
            }
            $this->occupiedSquares[] = $event->square();
        }

        $this->events[] = $event;
    }
}
