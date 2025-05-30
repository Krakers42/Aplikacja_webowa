<?php

use models\Bike;

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__. '/../models/Bike.php';
require_once __DIR__. '/../repositories/BikeRepository.php';

class BikeController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_FILE_TYPES = ['image/png', 'image/jpeg', 'image/jpg'];
    private $messages = [];
    private $bikeRepository;

    public function __construct()
    {
        parent::__construct();
        $this->bikeRepository = new BikeRepository();
    }


    public function add_bike() {
        if (
            $this->isPost()
            && isset($_POST['title'], $_POST['description'])
            && isset($_FILES['file'])
            && is_uploaded_file($_FILES['file']['tmp_name'])
            && $this->validate($_FILES['file'])
        ) {
            if(!isset($_SESSION['user'])) {
                return $this->render('login', ['messages' => ['You must be logged in to complete this task.']]);
            }

            $userId = $_SESSION['user']['id_user'];

            $bike = new Bike(
                $userId,
                $_POST['title'],
                $_POST['description'],
                file_get_contents($_FILES['file']['tmp_name']),
                $_FILES['file']['type']
            );

            $this->bikeRepository->addBike($bike);

            $_SESSION['success_message'] = 'Bike has been added';
            header('Location: /bikes');
            exit();
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

    public function delete_bike($id = null) {
        if (!$id || !isset($_SESSION['user'])) {
            header('Location: /bikes');
            exit();
        }

        $this->bikeRepository->deleteBike((int)$id, $_SESSION['user']['id_user']);
        header('Location: /bikes');
    }

}