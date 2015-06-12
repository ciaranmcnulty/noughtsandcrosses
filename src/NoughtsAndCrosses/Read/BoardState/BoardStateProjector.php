<?php

namespace NoughtsAndCrosses\Read\BoardState;

use NoughtsAndCrosses\Core\GameBegan;
use NoughtsAndCrosses\Core\Infrastructure\Event;
use NoughtsAndCrosses\Core\Infrastructure\EventListener;
use NoughtsAndCrosses\Core\MoveTaken;

class BoardStateProjector implements EventListener
{
    /**
     * @var
     */
    private $boardStateRepository;

    public function __construct(BoardStateRepository $boardStateRepository)
    {
        $this->boardStateRepository = $boardStateRepository;
    }

    public function handle(Event $event)
    {
        if ($event instanceof GameBegan) {
            $this->handleGameBegan($event);
        }
        elseif ($event instanceof MoveTaken) {
            $this->handleMoveTaken($event);
        }
    }

    private function handleGameBegan(GameBegan $gameBegan)
    {
        $this->boardStateRepository->add($gameBegan->id(), BoardState::start());
    }

    private function handleMoveTaken(MoveTaken $moveTaken)
    {
    }
}
