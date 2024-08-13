<?php

namespace App\GameOperations\Domain\Game;

use RuntimeException;

class GameNotFoundException extends RuntimeException
{
    public function __construct(string $gameId)
    {
        parent::__construct("Game with id {$gameId} not found");
    }
}