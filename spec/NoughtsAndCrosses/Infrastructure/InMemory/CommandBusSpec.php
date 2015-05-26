<?php

namespace spec\NoughtsAndCrosses\Infrastructure\InMemory;

use NoughtsAndCrosses\Core\Command\Command;
use NoughtsAndCrosses\Core\Command\CommandHandler;
use NoughtsAndCrosses\Infrastructure\InMemory\EventBus;
use NoughtsAndCrosses\Infrastructure\InMemory\CommandBus;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommandBusSpec extends ObjectBehavior
{
    function let(EventBus $eventBus, CommandHandler $commandHandler)
    {
        $this->beConstructedWith($eventBus, [$commandHandler->getWrappedObject()]);
    }

    function it_is_a_command_bus()
    {
        $this->shouldHaveType(CommandBus::class);
    }

    function it_dispatches_commands_which_have_handlers(Command $command, CommandHandler $commandHandler)
    {
        $this->dispatch($command);
        $commandHandler->handle($command)->shouldHaveBeenCalled();
    }
}
