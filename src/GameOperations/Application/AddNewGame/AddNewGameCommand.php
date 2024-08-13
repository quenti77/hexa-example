<?php

namespace App\GameOperations\Application\AddNewGame;

use App\Shared\Domain\Buses\CommandInterface;

class AddNewGameCommand implements CommandInterface
{
    public function __construct(
        public string $name,
        public string $description,
        public float $price,
        public string $currency,
        public string $platform,
    ) {
    }
}