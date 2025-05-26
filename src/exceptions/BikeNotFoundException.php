<?php

class BikeNotFoundException extends Exception {
    public function __construct($message = "User not found") {
        parent::__construct($message);
    }
}

