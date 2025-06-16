<?php

namespace models;


class User {
    private $email;
    private $password;
    private $name;
    private $surname;
    private $id_user;

    private $role;

    public function __construct(string $email, string $password, string $name, string $surname, string $role, string $id_user = null) {
        $this->id_user = $id_user;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->role = $role;
    }

    public function getRole(): string{
        return $this->role;
    }

    public function setRole(string $role): void{
        $this->role = $role;
    }

    public function getIdUser(): ?string
    {
        return $this->id_user;
    }

    public function setIdUser(string $id_user): void
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