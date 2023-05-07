<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Workshops extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "workshop";

        $this->getConnection();
    }

    /**
     * Get all workshops
     * @return array
     */
    public function getAllWorkshop(): array
    {
        $query = "SELECT * FROM " . $this->table . "";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get id of workshop
     * @return array
     */
    public function getWorkshopById(int $id): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_workshop = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Add a workshop
     * @param string $name
     * @param string $description
     * @param string $image
     * @param float $price
     * @param int $available
     * @param string $date
     * @param string $hour_start
     * @param string $hour_end
     * @return void
     */
    public function addWorkshop(string $name, string $description, string $image, float $price, int $available, string $date, string $hour_start, string $hour_end): void
    {
        $query = "INSERT INTO " . $this->table . "(name,description,image,price,available,date,hour_start,hour_end) VALUES (:name,:description,:image,:price,:available,:date,:hour_start,:hour_end)";

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


    /**
     * Get edit workshop
     * @return void
     */
    public function editProduct(string $name, string $description, string $image, int $disponibilitySale, int $disponibilityRental, int $disponibilityEvent,string $price_purchase, string $price_rental, int $disponibilityStock,int $id_equipment):void
    {
        $query = "UPDATE " . $this->table . " SET name = :name, description = :description, image = :image, allow_rental = :disponibilityRental, allow_event = :disponibilityEvent, allow_purchase = :disponibilitySale, price_purchase = :price_purchase, price_rental = :price_rental, stock = :disponibilityStock WHERE id_equipment = :id_equipment";
       
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
            ":id_equipment" => $id_equipment
        );

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute($data);

    }
    
    /**
     * delete workshop from workshops
     * @return bool
     */
    public function deleteProduct(int $id):bool
    {
        
        $query = "DELETE FROM " . $this->table . " WHERE id_equipment = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    
    }



}   
