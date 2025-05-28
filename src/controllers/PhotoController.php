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
        $this->photoRepository = new PhotoRepository();
    }

    public function handleRequest(): void
    {
        header('Content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
            $file = $_FILES['photo'];
            $imageType = $file['type'];
            $imageData = file_get_contents($file['tmp_name']);

            $userId = $_SESSION['user_id'] ?? null;
            if (!$userId) {
                http_response_code(401);
                echo json_encode(['error' => 'User must be logged in']);
                return;
            }

            $this->photoRepository->addPhoto($userId, $imageType, $imageData);
            echo json_encode(['success' => true]);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $userId = $_SESSION['user_id'] ?? null;

            if (!$userId) {
                http_response_code(401);
                echo json_encode(['error' => 'User must be logged in']);
                return;
            }

            $photos = $this->photoRepository->getPhotosByUser($userId);
            echo json_encode($photos);
            return;
        }

        http_response_code(405);
        echo json_encode(['error' => 'Invalid request method']);
    }

    /*
    public function delete_photo() {
        if (!isset($_POST['id_photo'])) {
            echo json_encode(['message' => 'No photo ID provided']);
            return;
        }

        $this->photoRepository->deletePhoto((int)$_POST['id_photo']);
        echo json_encode(['message' => 'Photo deleted']);
    }
    */
}