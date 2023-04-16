<?php
namespace Models;

use PDO;
use App\Model;
use PDOException;

class Shop extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "shopping_cart";

        $this->getConnection();
    }

    /**
     * Get all products
     * @return array
     */
    public function getAllProducts(): array
    {
        $query = "SELECT * FROM " . $this->table . "";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



     /**
     * verif if user have a cart
     * @return boolean
     */

    public function verifCart(int $id_users): bool
    {
 
    $query = "SELECT COUNT(id_shopping_cart) AS number FROM ". $this->table ." WHERE id_users = :id_users AND id_command_status < 1";

    $stmt = $this->_connexion->prepare($query);


    $data = array(
        ":id_users" => $id_users
    );

    $stmt->execute($data);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($result == 0){
        return false;
    }else{
        return true;
    }

    }


     /**
     * create cart
     * @return void
     */

    public function createCart(int $id_command_status,int $id_users): void
    {

    $query = "INSERT INTO".$this->table ."(id_command_status,id_users) VALUES (:id_command_status,:id_users)";

    $stmt = $this->_connexion->prepare($query);


    $data = array(
        ":id_command_status" => $id_command_status,
        ":id_users" => $id_users
    );

    $stmt->execute($data);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


    }

/**
     * add product to cart
     * @return void
     */

    public function addToCart(): void
    {

    $query = "";

    $stmt = $this->_connexion->prepare($query);


    $data = array(
        
    );

    $stmt->execute($data);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


    }
    







}