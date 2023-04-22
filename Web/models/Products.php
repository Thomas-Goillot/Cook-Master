<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Products extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "equipment";

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


    public function getEquipmentById(int $id_equipment): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_equipment = :id_equipment";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_equipment", $id_equipment);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Add a product
     * @param string $name
     * @param string $description
     * @param string $image
     * @param int $disponibilitySale
     * @param int $disponibilityRental
     * @param int $disponibilityEvent
     * @param int $disponibilityStock
     * @param int $id_users
     * @return void
     */
    public function addProduct(string $name, string $description, string $image, int $disponibilitySale, int $disponibilityRental, int $disponibilityEvent,string $price_purchase, string $price_rental, int $disponibilityStock,int $id_users): void
    {
        $query = "INSERT INTO " . $this->table . "(name,description,image,allow_rental,allow_event,allow_purchase,price_purchase,price_rental,stock,id_users) VALUES (:name,:description,:image,:disponibilityRental,:disponibilityEvent,:disponibilitySale,:price_purchase,:price_rental,:disponibilityStock,:id_users)";

        $data = array(
            ":name" => $name,
            ":description" => $description,
            ":image" => $image,
            ":disponibilityRental" => $disponibilityRental,
            ":disponibilityEvent" => $disponibilityEvent,
            ":price_purchase" => $price_purchase,
            ":price_rental" => $price_rental,
            ":disponibilitySale" => $disponibilitySale,
            ":disponibilityStock" => $disponibilityStock,
            ":id_users" => $id_users
        );

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute($data);
    }



    public function editProduct(string $name, string $description, string $image, int $disponibilitySale, int $disponibilityRental, int $disponibilityEvent,string $price_purchase, string $price_rental, int $disponibilityStock,int $id_equipment):void
    {
        $query = "UPDATE " . $this->table . " SET name = :name, description = :description, image = :image, disponibilityRental = :disponibilityRental, disponibilityEvent = :disponibilityEvent, price_purchase = :price_purchase, price_rental = :price_rental, disponibilitySale = :disponibilitySale, disponibilityStock = :disponibilityStock WHERE id_equipment = :id_equipment";
       
        $data = array(
            ":name" => $name,
            ":description" => $description,
            ":image" => $image,
            ":disponibilityRental" => $disponibilityRental,
            ":disponibilityEvent" => $disponibilityEvent,
            ":price_purchase" => $price_purchase,
            ":price_rental" => $price_rental,
            ":disponibilitySale" => $disponibilitySale,
            ":disponibilityStock" => $disponibilityStock,
            ":id_equipments" => $id_equipment
        );

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute($data);

    }
    


}
