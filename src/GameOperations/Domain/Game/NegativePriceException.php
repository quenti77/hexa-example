<?php

namespace App\GameOperations\Domain\Game;

use InvalidArgumentException;

class NegativePriceException extends InvalidArgumentException
{
    public function __construct(float $amount)
    {
        parent::__construct("Price amount must be greater than 0, current value is {$amount}");
    }
}