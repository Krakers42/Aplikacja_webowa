<?php

namespace models;

class Photo
{
    private int $id_user;
    private string $image_type;
    private string $image;

    public function __construct(int $id_user, string $image, string $image_type)
    {
        $this->id_user = $id_user;
        $this->image_type = $image_type;
        $this->image      = $image;
    }

    public function getImageBase64(): string {
        return 'data:' . $this->image_type . ';base64,' . base64_encode($this->image);
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

    public function setUserId(int $id_user): void {
        $this->id_user = $id_user;
    }

    public function setImage(string $image): void {
        $this->image = $image;
    }

    public function setImageType(string $image_type): void {
        $this->image_type = $image_type;
    }

}
