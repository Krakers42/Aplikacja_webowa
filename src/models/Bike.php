<?php

namespace models;
class Bike
{
    private $title;
    private $description;
    private $image;
    private $image_type;
    private $userId;

    public function __construct($userId, $title, $description, $image, $image_type)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->image_type = $image_type;
        $this->userId = $userId;
    }

    public function getImageType(): string
    {
        return $this->image_type;
    }

    public function setImageType(string $image_type)
    {
        $this->image_type = $image_type;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function setUserId(string $userId)
    {
        $this->userId = $userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getImage(): string|false|null
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }
}
