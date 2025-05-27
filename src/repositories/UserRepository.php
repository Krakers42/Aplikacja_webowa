<?php

use models\User;

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../exceptions/UserNotFoundException.php';


class UserRepository extends Repository {
    public function getUser(string $email): ?User {
        $stmt = $this->database->connect()->prepare(
            "SELECT u.id_user, u.email, u.password, d.name, d.surname 
                FROM users u 
                JOIN users_details d ON 
                u.id_user_details = d.id_user_details 
                WHERE u.email = :email
        ");
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
            $user['id_user']
        );
    }
}