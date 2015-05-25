<?php

namespace NoughtsAndCrosses\Infrastructure;

interface CommandHandler
{
    public function handle(Command $command);
}
