<?php

namespace App\Shared\Domain\Buses;

interface AsyncInterface
{
    public function getDelayInSeconds(int $delay): int;
}