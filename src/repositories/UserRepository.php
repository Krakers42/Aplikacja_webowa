<?php

use models\User;

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../exceptions/UserNotFoundException.php';


class UserRepository extends Repository {
    public function addUser(User $user): void {
        $stmt = $this->database->connect()->prepare(
            "INSERT INTO users (email, password, id_user_details)
         VALUES (:email, :password, :id_user_details)"
        );

        $email = $user->getEmail();
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $idUserDetails = $this->insertUserDetails($user->getName(), $user->getSurname(), $user->getRole());

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':id_user_details', $idUserDetails, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function getUser(string $email): ?User {
        $stmt = $this->database->connect()->prepare(
            "SELECT u.id_user, u.email, u.password, d.name, d.surname, d.role 
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
            $user['role'],
            $user['id_user']
        );
    }

    private function insertUserDetails(string $name, string $surname, string $role): int {
        $stmt = $this->database->connect()->prepare(
            "INSERT INTO users_details (name, surname, role) VALUES (:name, :surname, :role)"
        );

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->execute();

        return $this->database->connect()->lastInsertId();
    }

    public function getAllUsers(): array {
        $stmt = $this->database->connect()->prepare(
            "SELECT u.id_user, u.email, d.name, d.surname, d.role
         FROM users u
         JOIN users_details d ON u.id_user_details = d.id_user_details"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}