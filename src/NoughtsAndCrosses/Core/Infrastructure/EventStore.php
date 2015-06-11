<?php

namespace NoughtsAndCrosses\Core\Infrastructure;

interface EventStore
{
    public function findByAggregateId($identity);
}
