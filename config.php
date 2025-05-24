<?php

function loadEnv(string $path)
{
    if (!file_exists($path)) {
        throw new Exception(".env file not found at: $path");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (str_starts_with(trim($line), '#')) {
            continue;
        }

        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);

        $_ENV[$key] = $value;
        putenv("$key=$value");
    }
}

loadEnv(__DIR__ . '/.env');

define('USERNAME', $_ENV['DB_USERNAME']);
define('PASSWORD', $_ENV['DB_PASSWORD']);
define('HOST', $_ENV['DB_HOST']);
define('DATABASE', $_ENV['DB_DATABASE']);
