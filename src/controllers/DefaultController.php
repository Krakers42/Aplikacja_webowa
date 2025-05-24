<?php

require_once 'AppController.php';
require_once __DIR__.'/../repositories/BikeRepository.php';


class DefaultController extends AppController {

    public function index() {
        $this->render('login');
    }

    public function register() {
        $this->render('register');
    }

    public function forgot_password() {
        $this->render('forgot_password');
    }

    public function dashboard() {
        $this->render('dashboard');
    }

    public function bikes() {
        try {
            $bikeRepository = new BikeRepository();
            $bike_cards = $bikeRepository->getBikes();

            $this->render('bikes', ['bike_cards' => $bike_cards]);
        }
        catch (Exception $e) {
            $this->error404($e->getMessage());
        }
    }

    public function gear_parts() {
        $this->render('gear_parts');
    }

    public function photos() {
        $this->render('photos');
    }

    public function trips() {
        $this->render('trips');
    }

    public function account() {
        $this->render('account');
    }

    public function add_bike() {
        $this->render('add_bike');
    }

    public function error404(string $message = '') {
        http_response_code(404);
        $this->render('404', ['error' => $message]);
    }
}