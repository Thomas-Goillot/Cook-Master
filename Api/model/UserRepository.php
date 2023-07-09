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

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->executeQuery($query, [$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function createUser($name, $surname, $email, $phone, $password)
    {
        $query = "INSERT INTO users (name, surname, email, phone, password) VALUES (?, ?, ?, ?, ?)";
        $val = $this->executeQuery($query, [$name, $surname, $email, $phone, $password]);

        $query = "INSERT INTO subscribe_to (id_users,id_subscription) VALUES (LAST_INSERT_ID(),1)";

        $val2 = $this->executeQuery($query);

        if ($val && $val2) {
            return true;
        }

        return false;
    }

    public function getUserByEmailAndPassword($email, $password)
    {
        $query = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = $this->executeQuery($query, [$email, $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserCourses($id)
    {
        $query = "SELECT * FROM courses WHERE date_of_courses > NOW() AND id_users = ?";
        $stmt = $this->executeQuery($query, [$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $name, $surname, $email, $phone)
    {
        $query = "UPDATE users SET name = ?, surname = ?, email = ?, phone = ? WHERE id_users = ?";
        $val = $this->executeQuery($query, [$name, $surname, $email, $phone, $id]);

        if ($val) {
            return true;
        }

        return false;
    }

    public function getShop(){
        $query = "SELECT * FROM equipment WHERE allow_purchase = 0";
        $stmt = $this->executeQuery($query);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}