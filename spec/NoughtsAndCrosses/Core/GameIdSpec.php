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
}
