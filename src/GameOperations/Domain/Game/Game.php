<?php

namespace App\GameOperations\Domain\Game;

use DateTimeImmutable;

class Game
{
    public function __construct(
        private readonly GameId $id,
        private string $name,
        private string $description,
        private GamePrice $price,
        private GamePlatform $platform,
        private readonly DateTimeImmutable $createdAt,
        private DateTimeImmutable $updatedAt
    ) {
    }

    public function getId(): GameId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
        $this->update();
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
        $this->update();
    }

    public function getPrice(): GamePrice
    {
        return $this->price;
    }

    public function setPrice(GamePrice $price): void
    {
        $this->price = $price;
        $this->update();
    }

    public function getPlatform(): GamePlatform
    {
        return $this->platform;
    }

    public function setPlatform(GamePlatform $platform): void
    {
        $this->platform = $platform;
        $this->update();
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function update(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }
}