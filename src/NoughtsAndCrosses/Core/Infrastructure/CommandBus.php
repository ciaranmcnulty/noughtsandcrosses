<?php

namespace NoughtsAndCrosses\Core\Infrastructure;

interface CommandBus
{
    public function dispatch(Command $command);
}