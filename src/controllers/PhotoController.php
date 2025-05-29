<?php

use models\Photo;

require_once 'AppController.php';
require_once __DIR__ . '/../repositories/PhotoRepository.php';
require_once __DIR__ . '/../models/Photo.php';

class PhotoController extends AppController
{
    private PhotoRepository $photoRepository;

    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->photoRepository = new PhotoRepository();
    }

    public function handleRequest(): void
    {
        header('Content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
            $userId    = $_SESSION['user_id'] ?? null;
            if (!$userId) {
                http_response_code(401);
                echo json_encode(['error' => 'Not logged in']);
                return;
            }

            $file      = $_FILES['image'];
            $data      = file_get_contents($file['tmp_name']);
            $type      = $file['type'];

            try {
                $this->photoRepository->addPhoto($userId, $type, $data);
                $lastId = $this->photoRepository->getLastInsertedId();
                echo json_encode(['success' => true, 'id' => $lastId]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'DB error']);
            }
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $userId = $_SESSION['user_id'] ?? null;
            if (!$userId) {
                http_response_code(401);
                echo json_encode(['error' => 'Not logged in']);
                return;
            }

            $rows = $this->photoRepository->getPhotosByUser($userId);
            $out = array_map(fn($r) => [
                'id'         => $r['id_photo'],
                'image_type' => $r['image_type'],
                'image'      => base64_encode($r['image'])
            ], $rows);

            echo json_encode($out);
            return;
        }

        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
    }

    public function delete_photo(): void
    {
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId || !isset($_POST['id_photo'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Bad request']);
            return;
        }

        $this->photoRepository->deletePhoto((int)$_POST['id_photo'], $userId);
        echo json_encode(['success' => true]);
    }
}