<?php

namespace App\GameOperations\Domain\Game;

interface GameRepositoryInterface
{
    public function get(GameId $gameId): Game;

    public function save(Game $game): void;

    public function nextIdentity(): GameId;
}