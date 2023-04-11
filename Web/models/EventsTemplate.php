<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class EventsTemplate extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "event_template";

        $this->getConnection();
    }

    /**
     * Get all event template
     * @return array
     */
    public function getAllEventTemplate(): array
    {
        $query = "SELECT * FROM " . $this->table;

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get an event template by id
     * @param int $id
     * @return array
     */
    public function getEventTemplateById(int $id): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_event_template = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Add a new event template
     * @param string $name
     * @param string $description
     * @param float $price
     * @param int $id_users
     * @return bool
     */
    public function addEventTemplate(string $name, string $description, float $price, int $id_users): bool
    {
        $query = "INSERT INTO " . $this->table . " (name, description, price, id_users) VALUES (:name, :description, :price, :id_users)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id_users', $id_users);

        return $stmt->execute();
    }




}

?>