<?php

namespace App\GameOperations\Infrastructure\Doctrine\Entities;

use App\GameOperations\Domain\Game\GameId;
use App\GameOperations\Domain\Game\GamePlatform;
use App\GameOperations\Domain\Game\GamePrice;
use DateTimeImmutable;

class Game
{
    public function __construct(
        #[ORM\Id]
        private readonly string $id,
        private string $name,
        private string $description,
        private float $price,
        private string $currency,
        private GamePlatform $platform,
        private readonly DateTimeImmutable $createdAt,
        private DateTimeImmutable $updatedAt
    ) {
    }

    public function getId(): string
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
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
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

    public function setUpdatedAt(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }
}