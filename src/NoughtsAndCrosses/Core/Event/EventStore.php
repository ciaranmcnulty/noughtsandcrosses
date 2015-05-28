<?php

namespace NoughtsAndCrosses\Core\Event;

interface EventStore
{
    public function findByAggregateId($identity);
}
