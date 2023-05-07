<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class workshop extends Model
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
     * Get all workshop
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
     * @param string $date_start
     * @param string $date_end
     * @return void
     */
    public function addworkshop(string $name, string $description, string $image, float $price, int $available, string $date_start, string $date_end): void
    {
        $query = "INSERT INTO " . $this->table . "(name,description,image,price,available,date_start,date_end) VALUES (:name,:description,:image,:price,:available,:date_start,:date_end)";

        $data = array(
            ":name" => $name,
            ":description" => $description,
            ":image" => $image,
            ":price" => $price,
            ":available" => $available,
            ":date_start" => $date_start,
            ":date_end" => $date_end
        );

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute($data);
    }


    /**
     * Get edit workshop
     * @return void
     */
    public function editWorkshop(string $name, string $description, string $image, int $price, int $available, string $date_start, string $date_end, int $id_worshop):void
    {
        $query = "UPDATE " . $this->table . " SET name = :name, description = :description, image = :image, price = :price, available = : available, date_start = :date_start, date_end = :date_end WHERE id_equipment = :id_equipment";
       
        $data = array(
            ":name" => $name,
            ":description" => $description,
            ":image" => $image,
            ":price" => $price,
            ":available" => $available,
            ":date_start" => $date_start,
            ":date_end" => $date_end,
            ":id_worshop" => $id_worshop
        );

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute($data);

    }
    
    /**
     * delete workshop from workshop
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
