<?php

use models\Bike;

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__. '/../models/Bike.php';

class BikeController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_FILE_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages = [];
    public function add_bike() {
        if (
            $this->isPost()
            && isset($_POST['title'], $_POST['description'])
            && isset($_FILES['file'])
            && is_uploaded_file($_FILES['file']['tmp_name'])
            && $this->validate($_FILES['file'])
        ) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $bike = new Bike($_POST['title'], $_POST['description'], $_FILES['file']['name']);

            return $this->render('bikes', ['messages' => $this->messages, 'bike' => $bike]);
        }

        $this->render('add_bike', ['messages' => $this->messages]);
    }

    private function validate(array $file):bool {
        if($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too large to upload.';
            return false;
        }

        if(!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_FILE_TYPES)) {
            $this->messages[] = 'File type is not allowed.';
            return false;
        }

        return true;
    }
}