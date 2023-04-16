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





    public function verifCart(int $id_users): array
    {
 
    $query = "SELECT * FROM ". $this->table ." WHERE id_users = :id_users AND id_command_status < 1";

    $stmt = $this->_connexion->prepare($query);


    $data = array(
        ":id_users" => $id_users
    );

    $stmt->execute($data);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    







}