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
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserEvents($id){
        $query = "SELECT * FROM join_event, event WHERE join_event.id_users = ? AND event.date_start > NOW()";
        $stmt = $this->executeQuery($query, [$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPastUserEvents($id){
        $query = "SELECT * FROM join_event WHERE join_event.id_users = ? AND event.date_start < NOW()";
        $stmt = $this->executeQuery($query, [$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllEvents(){
        $query = "SELECT * FROM event WHERE date_start > NOW()";
        $stmt = $this->executeQuery($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSubscription($id){
        $query = "SELECT id_subscription FROM subscribe_to WHERE id_users = ?";
        $stmt = $this->executeQuery($query, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCartUser($id){
        $query = "SELECT id_shopping_cart FROM shopping_cart WHERE id_users = ? AND id_command_status =  1";
        $stmt = $this->executeQuery($query, [$id]);
        
        if($stmt->rowCount() == 0){
            $query = "INSERT INTO shopping_cart (id_users, id_command_status) VALUES (?, 1)";
            $stmt = $this->executeQuery($query, [$id]);
            $query = "SELECT id_shopping_cart FROM shopping_cart WHERE id_users = ? AND id_command_status =  1";
            $stmt = $this->executeQuery($query, [$id]);
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addProductToCart($id, $id_product, $quantity){
        $query = "SELECT * FROM contains WHERE id_equipment = ? AND id_shopping_cart = ?";
        $stmt = $this->executeQuery($query, [$id, $id_product]);
        
        if($stmt->rowCount() == 1){
            $query = "UPDATE contains SET quantity = quantity + ? WHERE id_equipment = ? AND id_shopping_cart = ?";
            $stmt = $this->executeQuery($query, [$quantity, $id_product, $id]); 
        }else{
            $query = "INSERT INTO contains (id_equipment, id_shopping_cart, quantity) VALUES (?, ?, ?)";
            $stmt = $this->executeQuery($query, [$id_product, $id, $quantity]);
        }
    }

    public function getAllProductsOfCart($id){
        $query = "SELECT * FROM contains WHERE id_shopping_cart = ?";
        $stmt = $this->executeQuery($query, [$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteProductOfCart($id, $id_product){
        $query = "DELETE FROM contains WHERE id_equipment = ? AND id_shopping_cart = ?";
        $stmt = $this->executeQuery($query, [$id_product, $id]);
    }
}