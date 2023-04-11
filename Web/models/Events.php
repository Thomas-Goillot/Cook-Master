<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Events extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "event";

        $this->getConnection();
    }

    /**
     * Get all events
     * @return array
     */
    public function getAllEvents(): array
    {
        $query = "SELECT * FROM " . $this->table;

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Add a new event
     * @param string $name
     * @param string $description
     * @param float $price
     * @param int $id_users
     * @return bool
     */
    public function addEvent(string $name, string $description, float $price, int $id_users, $date_start, $date_end): bool
    {
        $query = "INSERT INTO " . $this->table . " (name, description, price, id_users, date_start, date_end) VALUES (:name, :description, :price, :id_users, :date_start, :date_end)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":id_users", $id_users);
        $stmt->bindParam(":date_start", $date_start);
        $stmt->bindParam(":date_end", $date_end);

        return $stmt->execute();
    }




}

?>