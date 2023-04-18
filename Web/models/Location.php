<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Location extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "location";

        $this->getConnection();
    }

    /**
     * @param array $data
     * @return int
     */
    public function addLocation(array $data): int
    {
        $sql = "INSERT INTO " . $this->table . " (name, address, is_open, available_to_rental, price_day, price_half_day, id_users) VALUES (:name, :address, :is_open, :available_to_rental, :price_day, :price_half_day, :id_users)";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':is_open', $data['is_open']);
        $stmt->bindParam(':available_to_rental', $data['available_to_rental']);
        $stmt->bindParam(':price_day', $data['price_day']);
        $stmt->bindParam(':price_half_day', $data['price_half_day']);
        $stmt->bindParam(':id_users', $data['id_users']);

        $stmt->execute();

        return $this->_connexion->lastInsertId();
        
    }
}