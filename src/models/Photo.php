<?php

namespace models;

class Photo
{
    private $id_user;
    private $image;
    private $image_type;

    public function __construct(int $id_user, string $image, string $image_type)
    {
        $this->id_user = $id_user;
        $this->image = $image;
        $this->image_type = $image_type;
    }

    public function getUserId(): int {
        return $this->id_user;
    }
    public function getImage(): string {
        return $this->image;
    }
    public function getImageType(): string {
        return $this->image_type;
    }
}
