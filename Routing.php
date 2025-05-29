<?php

require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/BikeController.php';
require_once 'src/controllers/PhotoController.php';

class Routing extends AppController {
    public static $routes;

    public static function get($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function run($url) {
        $urlParts = explode('/', $url);
        $action = $urlParts[0];

        if(!array_key_exists($action, self::$routes)) {
            $controller = new DefaultController();
            $controller->error404();
            return;
        }

        $controller = self::$routes[$action];
        $object = new $controller;

        $actionMethod = $urlParts[1] ?? $action;
        $id = $urlParts[2] ?? null;

        if (!method_exists($object, $actionMethod)) {
            $default = new DefaultController();
            $default->error404();
            return;
        }

        $object->$actionMethod($id);
    }

}