<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class PersonnalEvents extends Model
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
     * @param int $id 
     * @return array
     */
    public function getAllPersonnalEvents(int $id): array
    {
        $query = "SELECT event.* , users.id_users FROM " . $this->table . ", users WHERE event.id_users = :id_users AND  users.id_users = :id_users";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Get upcoming events
     * @param int $id 
     * @return array
     */
    public function getUpcomingPersonnalEvents(int $id): array
    {
        $query = "SELECT event.* , users.id_users FROM " . $this->table . ", users WHERE event.id_users = :id_users AND  users.id_users = :id_users AND event.date_end > NOW()";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Get past events
     * @param int $id 
     * @return array
     */
    public function getPastPersonnalEvents(int $id): array
    {
        $query = "SELECT event.* , users.id_users FROM " . $this->table . ", users WHERE event.id_users = :id_users AND  users.id_users = :id_users AND event.date_end < NOW()";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}