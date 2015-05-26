<?php

namespace spec\NoughtsAndCrosses\Infrastructure\InMemory;

use NoughtsAndCrosses\Core\Event\Event;
use NoughtsAndCrosses\Infrastructure\InMemory\EventBus;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EventBusSpec extends ObjectBehavior
{
    function it_is_an_event_bus()
    {
        $this->shouldHaveType(EventBus::class);
    }

    function it_stores_dispatched_events(Event $event)
    {
        $this->dispatch($event);
        $this->getEvents()->shouldBeLike([$event->getWrappedObject()]);
    }
}
