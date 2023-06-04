<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Events extends Model
{
    /**
     * event constructor.
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
     * Get event info by id
     * @param int $id
     * @return array
     */
    public function getEventById(int $id): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_event = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Add a new event
     * @param string $name
     * @param string $description
     * @param float $price
     * @param int $id_users
     * @param string $date_start
     * @param string $date_end
     * @param int $place
     * @param string $image
     * @param string $slug
     * @return bool
     */
    public function addEvent(string $name, string $description, float $price, int $id_users, string $date_start, string $date_end, int $place, string $image, string $slug): bool
    {
        $query = "INSERT INTO " . $this->table . " (name, description, price, id_users, date_start, date_end, place, image, slug) VALUES (:name, :description, :price, :id_users, :date_start, :date_end, :place, :image, :slug)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":id_users", $id_users);
        $stmt->bindParam(":date_start", $date_start);
        $stmt->bindParam(":date_end", $date_end);
        $stmt->bindParam(":place", $place);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":slug", $slug);

        return $stmt->execute();
    }

    /**
     * Update an event
     * @param int $id
     * @param string $name
     * @param string $description
     * @param float $price
     * @param int $id_users
     * @param string $date_start
     * @param string $date_end
     * @param int $place
     * @return bool
     */
    public function updateEvent(int $id, string $name, string $description, float $price, int $id_users, string $date_start, string $date_end, int $place): bool
    {
        $query = "UPDATE " . $this->table . " SET name = :name, description = :description, price = :price, id_users = :id_users, date_start = :date_start, date_end = :date_end, place = :place WHERE id_event = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":id_users", $id_users);
        $stmt->bindParam(":date_start", $date_start);
        $stmt->bindParam(":date_end", $date_end);
        $stmt->bindParam(":place", $place);

        return $stmt->execute();
    }

    /**
     * Delete an event
     * @param int $id
     * @return bool
     */

    public function deleteEvent(int $id): bool
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_event = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    /**
     * Delete all providers for an event
     * @param int $id
     * @return bool
     */
    public function deleteProviderEvent(int $id): bool
    {
        $query = "DELETE FROM provider_occurs WHERE id_event = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    /**
     * Delete all participants for an event
     * @param int $id
     * @return bool
     */
    public function deleteParticipantEvent(int $id): bool
    {
        $query = "DELETE FROM join_event WHERE id_event = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }


    /**
     * reservationEvent
     * @param int $id_event
     * @param int $id_users
     * @return void
     */
    public function reservationEvent(int $id_event, int $id_users): void{
        $query = "INSERT INTO join_event (id_event, id_users) VALUES (:id_event,:id_users)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_event", $id_event);
        $stmt->bindParam(":id_users", $id_users);

        $stmt->execute();
    }

}

?>