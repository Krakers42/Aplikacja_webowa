<?php

require_once __DIR__ . '/../repositories/GearPartsRepository.php';

class GearPartsController extends AppController {
    public function __construct()
    {
        parent::__construct();
        $this->repository = new GearPartsRepository();
    }
    private GearPartsRepository $repository;

    public function gear_parts() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            switch ($action) {
                case 'add':
                    $this->addGearPart($_POST);
                    break;
                case 'edit':
                    $id = (int)($_POST['id'] ?? 0);
                    if ($id > 0) {
                        $this->editGearPart($id, $_POST);
                    }
                    break;
                case 'delete':
                    $id = (int)($_POST['id'] ?? 0);
                    if ($id > 0) {
                        $this->deleteGearPart($id);
                    }
                    break;
            }

            header("Location: /gear_parts");
            exit;
        } else {
            $this->showList();
        }
    }

    private function showList() {
        $gearParts = $this->repository->getAllGearParts();
        require_once __DIR__ . '/../../public/views/gear_parts.php';
    }

    private function addGearPart(array $data) {
        $name = trim($data['name'] ?? '');
        if ($name !== '') {
            $this->repository->addGearPart($data);
        }
    }

    private function editGearPart(int $id, array $data) {
        $name = trim($data['name'] ?? '');
        if ($name !== '') {
            $this->repository->updateGearPart($id, $data);
        }
    }

    private function deleteGearPart(int $id) {
        $this->repository->deleteGearPart($id);
    }
}
