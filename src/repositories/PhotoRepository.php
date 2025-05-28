<?php

use models\Photo;

require_once 'Repository.php';
require_once __DIR__ . '/../models/Photo.php';

class PhotoRepository extends Repository
{
    public function addPhoto(int $userId, string $imageType, string $imageData): void
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO photos (id_user, image_type, image) 
            VALUES (?, ?, ?)
        ');
        $stmt->bindValue(1, $userId, PDO::PARAM_INT);
        $stmt->bindValue(2, $imageType, PDO::PARAM_STR);
        $stmt->bindValue(3, $imageData, PDO::PARAM_LOB);
        $stmt->execute();
    }

    public function deletePhoto(int $id): void {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM photos
            WHERE id_photo = ?');
        $stmt->execute([$id]);
    }

    public function getPhotosByUser(int $id_user): array {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM photos
            WHERE id_user = ?');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}