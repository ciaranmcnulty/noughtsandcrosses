<?php

namespace NoughtsAndCrosses\Core;

use Rhumsaa\Uuid\Uuid;

class GameId
{
    private $uuid;

    private function __construct(Uuid $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function createNew()
    {
        return new static(Uuid::uuid4());
    }

    public static function fromUrlToken($string)
    {
        return new static(Uuid::fromBytes(base64_decode(strtr($string, '-_', '+/'))));
    }

    public function asUrlToken()
    {
        return strtr(trim(base64_encode($this->uuid->getBytes()),'='), '+/', '-_');
    }
}
