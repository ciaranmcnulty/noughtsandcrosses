<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Infrastructure\Command;
use NoughtsAndCrosses\Core\Infrastructure\CommandHandler;
use NoughtsAndCrosses\Core\BeginGame;
use NoughtsAndCrosses\Core\GameBegan;
use NoughtsAndCrosses\Core\GameId;
use NoughtsAndCrosses\Bridge\InMemory\EventBus;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HandleBeginGameSpec extends ObjectBehavior
{
    private $gameIdentity;

    function let(EventBus $eventBus)
    {
        $this->gameIdentity = GameId::createNew();
        $this->beConstructedWith($eventBus);
    }

    function it_is_a_command_handler()
    {
        $this->shouldHaveType(CommandHandler::class);
    }

    function it_supports_begin_game_command()
    {
        $this->supports(new BeginGame($this->gameIdentity))->shouldReturn(true);
    }

    function it_does_not_support_other_commands(Command $command)
    {
        $this->supports($command)->shouldReturn(false);
    }

    function it_begins_game_when_handling_create_game_command(EventBus $eventBus)
    {
        $this->handle(new BeginGame($this->gameIdentity));

        $eventBus->dispatchAll([new GameBegan($this->gameIdentity)])->shouldHaveBeenCalled();
    }
}
