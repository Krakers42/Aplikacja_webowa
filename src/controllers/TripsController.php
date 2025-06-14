<?php

require_once __DIR__ . '/../repositories/TripsRepository.php';

class TripsController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->repository = new TripsRepository();
    }

    private TripsRepository $repository;

    public function trips() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            switch ($action) {
                case 'add':
                    $this->addTrip($_POST);
                    break;
                case 'edit':
                    $id = (int)($_POST['id'] ?? 0);
                    if ($id > 0) {
                        $this->editTrip($id, $_POST);
                    }
                    break;
                case 'delete':
                    $id = (int)($_POST['id'] ?? 0);
                    if ($id > 0) {
                        $this->deleteTrip($id);
                    }
                    break;
            }

            header("Location: /trips");
            exit;
        } else {
            $this->showList();
        }
    }

    private function showList()
    {
        $trips = $this->repository->getAllTrips();
        require_once __DIR__ . '/../../public/views/trips.php';
    }

    private function addTrip(array $data)
    {
        if (!empty($data['date'])) {
            $this->repository->addTrips($data);
        }
    }

    private function editTrip(int $id, array $data)
    {
        if (!empty($data['date'])) {
            $this->repository->updateTrip($id, $data);
        }
    }

    private function deleteTrip(int $id)
    {
        $this->repository->deleteTrip($id);
    }
}
