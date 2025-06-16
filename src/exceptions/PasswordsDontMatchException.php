<?php

class PasswordsDontMatchException extends Exception
{
    public function __construct($message = "Wrong password!")
    {
        parent::__construct($message);
    }
}

