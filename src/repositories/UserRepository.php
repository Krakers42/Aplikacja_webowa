<?php

use models\User;

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../exceptions/UserNotFoundException.php';


class UserRepository extends Repository {
    public function getUser(string $email): ?User {
        $stmt = $this->database->connect()->prepare(
            "SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$user) {
            throw new UserNotFoundException("User with email {$email} not found.");
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
        );
    }
}