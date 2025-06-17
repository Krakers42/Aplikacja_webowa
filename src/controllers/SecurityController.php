<?php

use models\User;

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repositories/UserRepository.php';
require_once __DIR__.'/../../Routing.php';
require_once __DIR__.'/../exceptions/PasswordsDontMatchException.php';

class SecurityController extends AppController {

    private function incrementLoginAttempts(int &$attempts): void {
        $attempts++;
    }

    public function login() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $userRepository = new UserRepository();

        $maxAttempts = 3;
        $banDuration = 60;

        if(!$this->isPost()) {
            return $this->render('login');
        }

        if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
        }

        if (!isset($_SESSION['last_failed_login'])) {
            $_SESSION['last_failed_login'] = time();
        }

        if ($_SESSION['login_attempts'] >= $maxAttempts) {
            $elapsed = time() - $_SESSION['last_failed_login'];

            if ($elapsed < $banDuration) {
                $remaining = ceil(($banDuration - $elapsed) / 60);
                return $this->render('login', ['messages' => ["Too many attempts. Try again in $remaining minutes."]]);
            } else {
                $_SESSION['login_attempts'] = 0;
                $_SESSION['last_failed_login'] = time();
            }
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        try {
            $user = $userRepository->getUser($email);
        }
        catch (UserNotFoundException $e) {
            $this->incrementLoginAttempts($_SESSION['login_attempts']);
            $_SESSION['last_failed_login'] = time();
            return $this->render('login', ['messages' => [$e->getMessage()]]);
        }

        if ($user->getEmail() !== $email) {
            $this->incrementLoginAttempts($_SESSION['login_attempts']);
            $_SESSION['last_failed_login'] = time();
            return $this->render('login', ['messages' => ['User with this email does not exist!']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            $this->incrementLoginAttempts($_SESSION['login_attempts']);
            $_SESSION['last_failed_login'] = time();
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $_SESSION['login_attempts'] = 0;

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

        try {
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if ($password !== $confirmPassword) {
                throw new PasswordsDontMatchException();
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
        } catch (PasswordsDontMatchException $e) {
            return $this->render('register', ['messages' => ['Passwords do not match!']]);
        }
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