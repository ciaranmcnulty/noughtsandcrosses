<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Command\Command;
use NoughtsAndCrosses\Core\Command\CommandHandler;
use NoughtsAndCrosses\Core\Event\EventBus;
use NoughtsAndCrosses\Core\Game;
use NoughtsAndCrosses\Core\GameHasBegun;
use NoughtsAndCrosses\Core\GameIdentity;
use NoughtsAndCrosses\Core\Games;
use NoughtsAndCrosses\Core\Player;
use NoughtsAndCrosses\Core\PlaySquareByPlayer;
use NoughtsAndCrosses\Core\Square;
use NoughtsAndCrosses\Core\SquarePlayedByPlayer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HandlePlaySquareByPlayerSpec extends ObjectBehavior
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
        $this->supports(new PlaySquareByPlayer(GameIdentity::createNew(), Square::atPosition("A", 1), Player::X()))->shouldReturn(true);
    }

    function it_does_not_support_other_commands(Command $command)
    {
        $this->supports($command)->shouldReturn(false);
    }

    function it_emits_a_square_played_by_player_event_when_square_is_played(EventBus $eventBus, Games $games)
    {
        $id = GameIdentity::createNew();
        $game = Game::fromEvents([ new GameHasBegun($id)]);
        $games->findById($id)->willReturn($game);

        $this->handle(new PlaySquareByPlayer($id, Square::atPosition("A", 1), Player::X()));

        $eventBus->dispatchAll([new SquarePlayedByPlayer($id, Square::atPosition("A", 1), Player::X())])->shouldHaveBeenCalled();
    }
}
