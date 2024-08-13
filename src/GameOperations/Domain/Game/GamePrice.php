<?php

namespace App\GameOperations\Domain\Game;

class GamePrice
{
    public function __construct(
        public readonly int $amount,
        public readonly string $currency,
    ) {
        if ($amount < 0) {
            throw new NegativePriceException($amount);
        }
    }

    public static function create(float $amount, string $currency): self
    {
        return new self($amount * 100, $currency);
    }
}