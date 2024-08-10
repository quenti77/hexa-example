<?php

namespace App\Shared\Domain\Buses;

interface CommandResponseInterface
{
    /**
     * @return array | array<string, mixed>
     */
    public function toArray(): array;
}