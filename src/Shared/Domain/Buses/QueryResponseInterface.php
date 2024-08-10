<?php

namespace App\Shared\Domain\Buses;

interface QueryResponseInterface
{
    /**
     * @return array | array<string, mixed>
     */
    public function toArray(): array;
}