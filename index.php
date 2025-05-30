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
Routing::post('add_bike', 'BikeController');

Routing::get('photos/handleRequest', 'PhotoController');
Routing::post('photos/handleRequest', 'PhotoController');
Routing::post('photos/delete_photo', 'PhotoController');

Routing::get('bikeController/delete_bike', 'BikeController');

Routing::run($path);
