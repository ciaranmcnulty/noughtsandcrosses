<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Infrastructure\Command;
use NoughtsAndCrosses\Core\Infrastructure\CommandHandler;
use NoughtsAndCrosses\Core\Infrastructure\EventBus;
use NoughtsAndCrosses\Core\Game;
use NoughtsAndCrosses\Core\GameBegan;
use NoughtsAndCrosses\Core\GameId;
use NoughtsAndCrosses\Core\Games;
use NoughtsAndCrosses\Core\Player;
use NoughtsAndCrosses\Core\TakeMove;
use NoughtsAndCrosses\Core\Square;
use NoughtsAndCrosses\Core\MoveTaken;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HandleTakeMoveSpec extends ObjectBehavior
{
    function let(EventBus $eventBus, Games $games)
    {
        $this->beConstructedWith($eventBus, $games);
    }

    function it_is_a_command_handler()
    {
        $this->shouldHaveType(CommandHandler::class);
    }

    function it_supports_square_played_by_player()
    {
        $this->supports(new TakeMove(GameId::createNew(), Square::atPosition("A", 1), Player::X()))->shouldReturn(true);
    }

    function it_does_not_support_other_commands(Command $command)
    {
        $this->supports($command)->shouldReturn(false);
    }

    function it_emits_a_square_played_by_player_event_when_square_is_played(EventBus $eventBus, Games $games)
    {
        $id = GameId::createNew();
        $game = Game::fromEvents([ new GameBegan($id)]);
        $games->findById($id)->willReturn($game);

        $this->handle(new TakeMove($id, Square::atPosition("A", 1), Player::X()));

        $eventBus->dispatchAll([new MoveTaken($id, Square::atPosition("A", 1), Player::X())])->shouldHaveBeenCalled();
    }
}
