<?php

namespace App\GameOperations\Domain\Game;

class GameId
{
    public function __construct(public readonly string $value)
    {
    }
}