<?php

namespace models;
class Bike
{
    private $title;
    private $description;
    private $image;

    private $image_type;

    public function getImageType(): string
    {
        return $this->image_type;
    }

    public function setImageType(): string
    {
        return $this->image_type;
    }

    public function __construct($title, $description, $image, $image_type)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->image_type = $image_type;
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

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }
}
