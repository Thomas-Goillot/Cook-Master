<?php

namespace Model;
use App\Database;
use PDO;

class UserRepository extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->executeQuery($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM users WHERE id_users = ?";
        $stmt = $this->executeQuery($query, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($name, $email)
    {
        $query = "INSERT INTO users (name, email) VALUES (?, ?)";
        $this->executeQuery($query, [$name, $email]);
    }

    public function getUserByEmailAndPassword($email, $password)
    {
        $query = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = $this->executeQuery($query, [$email, $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}