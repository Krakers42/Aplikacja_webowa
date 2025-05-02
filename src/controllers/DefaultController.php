<?php

require_once 'AppController.php';
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
        $this->render('bikes');
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
}