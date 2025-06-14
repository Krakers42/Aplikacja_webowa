<?php

require_once 'AppController.php';
require_once __DIR__. '/../repositories/TripsRepository.php';
require_once __DIR__. '/../repositories/PhotoRepository.php';

class DashboardController extends AppController
{
    public function dashboard()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit();
        }

        $tripRepo = new TripsRepository();
        $photoRepo = new PhotoRepository();

        $longestRide = $tripRepo->getLongestDistance();
        $tripCount = $tripRepo->getTripCount();
        $totalDistance = $tripRepo->getTotalDistance();
        $photoCount = $photoRepo->getPhotoCount();
        $maxElevation = $tripRepo->getMaxElevation();

        require_once __DIR__ . '/../../public/views/dashboard.php';
    }
}
