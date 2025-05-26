<?php

namespace models;

class User {
    private $email;
    private $password;
    private $name;
    private $surname;
    private $id_user;

    public function __construct(string $email, string $password, string $name, string $surname, int $id_user) {
        $this->id_user = $id_user;
        $this->email = $email;
        $this->password = $password;
        $this->surname = $name;
        $this->name = $surname;
    }

    public function getIdUser(): int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function setSurname(string $surname): void {
        $this->surname = $surname;
    }
}