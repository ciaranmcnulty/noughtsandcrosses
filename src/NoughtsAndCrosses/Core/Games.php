<?php

namespace NoughtsAndCrosses\Core;

interface Games
{
    public function findById(GameIdentity $id);
}
