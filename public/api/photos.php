<?php
session_start();

require_once __DIR__ . '/../../src/repositories/PhotoRepository.php';

header('Content-Type: application/json');

$photoRepository = new PhotoRepository();
$method = $_SERVER['REQUEST_METHOD'];
$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    http_response_code(401);
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

switch ($method) {
    case 'GET':
        $photos = $photoRepository->getPhotosByUser($userId);
        $out = array_map(fn($r) => [
            'id'         => $r['id_photo'],
            'image_type' => $r['image_type'],
            'image'      => base64_encode($r['image'])
        ], $photos);
        echo json_encode($out);
        break;

    case 'POST':
        if (!isset($_FILES['image'])) {
            http_response_code(400);
            echo json_encode(['error' => 'No image provided']);
            break;
        }

        $file = $_FILES['image'];
        $data = file_get_contents($file['tmp_name']);
        $type = $file['type'];

        try {
            $photoRepository->addPhoto($userId, $type, $data);
            $lastId = $photoRepository->getLastInsertedId();
            echo json_encode(['success' => true, 'id' => $lastId]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'DB error']);
        }
        break;

    case 'DELETE':
        parse_str(file_get_contents("php://input"), $params);
        $id_photo = $params['id_photo'] ?? null;

        if (!$id_photo) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing id_photo']);
            break;
        }

        $photoRepository->deletePhoto((int)$id_photo, $userId);
        echo json_encode(['success' => true]);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}
