<?php

use models\User;

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repositories/UserRepository.php';
require_once __DIR__.'/../../Routing.php';

class SecurityController extends AppController {
    public function login() {
        $userRepository = new UserRepository();

        if(!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        try {
            $user = $userRepository->getUser($email);
        }
        catch (UserNotFoundException $e) {
            return $this->render('login', ['messages' => [$e->getMessage()]]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email does not exist!']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $_SESSION['user'] = [
            'id_user' => $user->getIdUser(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'role' => $user->getRole()
        ];

        $_SESSION['user_id'] = $user->getIdUser();
        header("Location: /dashboard");
        exit();
    }

    public function getAllUsers(): array {
        error_log('getAllUsers called');

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Access denied']);
            exit();
        }

        $userRepository = new UserRepository();
        $users = $userRepository->getAllUsers();

        error_log(print_r($users, true));

        header('Content-Type: application/json');
        echo json_encode($users);
        exit();
    }

    public function register() {
        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $role = $_POST['role'];

        $user = new User($email, $password, $name, $surname, $role);

        $userRepository = new UserRepository();
        $userRepository->addUser($user);

        header("Location: /login");
        exit();
    }

    public function deleteUser() {
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            exit();
        }

        $currentUser = $_SESSION['user'];
        $idToDelete = $_POST['id_user'] ?? null;

        if (!$idToDelete) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing user ID']);
            exit();
        }

        if ($currentUser['role'] !== 'admin' && $currentUser['id_user'] != $idToDelete) {
            http_response_code(403);
            echo json_encode(['error' => 'Forbidden']);
            exit();
        }

        $userRepository = new UserRepository();
        $userRepository->deleteUser((int)$idToDelete);

        if ($currentUser['id_user'] == $idToDelete) {
            session_destroy();
            echo json_encode(['redirect' => '/login']);
            exit();
        }

        echo json_encode(['success' => true]);
        exit();
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login");
        exit();
    }
}