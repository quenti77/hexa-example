<?php

namespace App\GameOperations\Application\AddNewGame;

use App\GameOperations\Domain\Game\GameId;
use App\Shared\Domain\Buses\CommandResponseInterface;

class AddNewGameResponse implements CommandResponseInterface
{
    public function __construct(private readonly GameId $gameId)
    {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->gameId->value,
        ];
    }
}