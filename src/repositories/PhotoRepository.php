<?php

use models\Photo;
require_once 'Repository.php';

class PhotoRepository extends Repository
{
    public function addPhoto(int $userId, string $type, string $data): void
    {
        $sql = 'INSERT INTO photos (id_user, image_type, image) VALUES (?, ?, ?)';
        $stmt = $this->database->connect()->prepare($sql);
        $stmt->bindValue(1, $userId, PDO::PARAM_INT);
        $stmt->bindValue(2, $type,   PDO::PARAM_STR);
        $stmt->bindValue(3, $data,   PDO::PARAM_LOB);
        $stmt->execute();
    }

    public function getPhotosByUser(int $userId): array
    {
        $sql = 'SELECT id_photo, image_type, image FROM photos WHERE id_user = ? ORDER BY id_photo DESC';
        $stmt = $this->database->connect()->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletePhoto(int $idPhoto, int $userId): void
    {
        $sql = 'DELETE FROM photos WHERE id_photo = ? AND id_user = ?';
        $stmt = $this->database->connect()->prepare($sql);
        $stmt->execute([$idPhoto, $userId]);
    }

    public function getLastInsertedId(): int {
        return $this->database->connect()->lastInsertId();
    }

    public function getPhotoCount(): int {
        $stmt = $this->database->connect()->prepare("
            SELECT COUNT(id_photo) as photo_count 
            FROM photos 
            WHERE id_user = :id_user
        ");
        $stmt->execute(['id_user' => $_SESSION['user']['id_user']]);
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['photo_count'] ?? 0;
    }

}
