<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('index', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('forgot_password', 'DefaultController');
Routing::get('dashboard', 'DefaultController');
Routing::get('bikes', 'DefaultController');
Routing::get('gear_parts', 'DefaultController');
Routing::get('photos', 'DefaultController');
Routing::get('trips', 'DefaultController');
Routing::get('account', 'DefaultController');

Routing::post('index', 'SecurityController');

Routing::run($path);
