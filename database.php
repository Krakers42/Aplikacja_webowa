<?php

require_once "config.php";

class Database {
    private static ?Database $instance = null;
    private ?PDO $connection = null;

    private $username;
    private $password;
    private $host;
    private $database;

    private function __construct()
    {
        $this->username = USERNAME;
        $this->password = PASSWORD;
        $this->host = HOST;
        $this->database = DATABASE;
    }

    public static function getInstance(): Database{
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function connect(): PDO {
        if ($this->connection === null) {
            try {
                $this->connection = new PDO(
                    "pgsql:host=$this->host;port=5432;dbname=$this->database",
                    $this->username,
                    $this->password,
                    ["sslmode" => "prefer"]
                );

                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new Exception("Database connection failed: " . $e->getMessage());
            }
        }
        return $this->connection;
    }

    public function disconnect(){
        $this->connection = null;
    }

}