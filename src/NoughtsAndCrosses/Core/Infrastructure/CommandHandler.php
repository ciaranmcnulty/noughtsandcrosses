<?php

namespace NoughtsAndCrosses\Core\Infrastructure;

interface CommandHandler
{
    public function supports(Command $command);

    public function handle(Command $command);
}
