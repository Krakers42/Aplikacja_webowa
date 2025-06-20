<?php

require 'Routing.php';

$rawPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($rawPath, '/');

if ($path === '') {
    $path = 'index';
}

Routing::get('', 'DefaultController');
Routing::get('/', 'DefaultController');
Routing::get('index', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('forgot_password', 'DefaultController');
Routing::get('dashboard', 'DefaultController');
Routing::get('bikes', 'DefaultController');
Routing::get('gear_parts', 'DefaultController');
Routing::get('photos', 'DefaultController');
Routing::get('trips', 'DefaultController');
Routing::get('account', 'DefaultController');

Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('logout', 'SecurityController');

Routing::get('getAllUsers', 'SecurityController');

Routing::get('getPhoto', 'PhotoController');
Routing::post('postPhoto', 'PhotoController');
Routing::post('deletePhoto', 'PhotoController');

Routing::post('add_bike', 'BikeController');
Routing::get('get_bikes', 'BikeController');
Routing::post('delete_bike', 'BikeController');
Routing::post('edit_bike', 'BikeController');

Routing::get('gear_parts', 'GearPartsController');
Routing::post('gear_parts', 'GearPartsController');

Routing::get('trips', 'TripsController');
Routing::post('trips', 'TripsController');

Routing::get('dashboard', 'DashboardController');

Routing::post('deleteUser', 'SecurityController');

Routing::run($path);
