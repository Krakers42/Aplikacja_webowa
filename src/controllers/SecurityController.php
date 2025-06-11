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
        ];

        $_SESSION['user_id'] = $user->getIdUser();
        header("Location: /dashboard");
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

        $user = new User($email, $password, $name, $surname);

        $userRepository = new UserRepository();
        $userRepository->addUser($user);

        header("Location: /login");
        exit();
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login");
        exit();
    }


}