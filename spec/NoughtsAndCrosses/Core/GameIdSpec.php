<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\GameId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameIdSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('createNew', []);
    }

    function it_has_an_identity()
    {
        $this->shouldBeLike($this);
    }

    function it_is_not_equal_to_other_ids()
    {
        $this->shouldNotBeLike(GameId::createNew());
    }

    function it_can_be_turned_into_a_string()
    {
        $this->beConstructedThrough('fromUrlToken', ['gPF_x4ULSGCq-Th6rpv7rw']);

        $this->asUrlToken()->shouldReturn('gPF_x4ULSGCq-Th6rpv7rw');
    }
}
