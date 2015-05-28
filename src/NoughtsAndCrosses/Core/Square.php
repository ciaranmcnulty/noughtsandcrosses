<?php

namespace NoughtsAndCrosses\Core;

class Square
{
    private $row;
    private $column;

    private function __construct($row, $column)
    {
        $this->row = $row;
        $this->column = $column;
    }

    public static function atPosition($row, $column)
    {
        return new Square($row, $column);
    }
}
