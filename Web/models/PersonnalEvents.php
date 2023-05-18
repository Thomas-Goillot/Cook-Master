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
        $query = "SELECT event.* FROM event, join_event WHERE event.id_event = join_event.id_event AND join_event.id_users = :id_users";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Get all upcoming events
     * @param int $id 
     * @return array
     */
    public function getUpcomingPersonnalEvents(int $id): array
    {
<<<<<<< Updated upstream
        $query = "SELECT event.* FROM event, join_event WHERE event.id_event = join_event.id_event AND join_event.id_users = :id_users AND event.date_end > NOW()";
=======
        $query = "SELECT event.*, join_event.* FROM event, join_event WHERE event.id_event = join_event.id_event AND join_event.id_users = :id_users AND event.date_end > NOW()";
>>>>>>> Stashed changes
        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Get all past events
     * @param int $id 
     * @return array
     */
    public function getPastPersonnalEvents(int $id): array
    {
        $query = "SELECT event.* FROM event, join_event WHERE event.id_event = join_event.id_event AND join_event.id_users = :id_users AND event.date_end < NOW()";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Get one upcoming events
     * @param int $id 
     * @param int $id_event
     * @return array
     */
    public function getUpcomingPersonnalEvent(int $id, int $id_event): array
    {
        $query = "SELECT event.* , users.id_users FROM " . $this->table . ", users WHERE event.id_users = :id_users AND  users.id_users = :id_users AND event.date_end > NOW() AND event.id_event = :id_event";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id);

        $stmt->bindParam(":id_event", $id_event);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Get one past event
     * @param int $id
     * @param int $id_event 
     * @return array
     */
    public function getPastPersonnalEvent(int $id, int $id_event): array
    {
        $query = "SELECT event.* , users.id_users FROM " . $this->table . ", users WHERE event.id_users = :id_users AND  users.id_users = :id_users AND event.date_end < NOW() AND event.id_event = :id_event";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id);

        $stmt->bindParam(":id_event", $id_event);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }



    /**
     * delete personnal event
     * @param int $id
     * @param int $id_event 
     * @return array
     */
    public function deleteEvent(int $id, int $id_join_event): array
    {
        $query = "DELETE FROM join_event WHERE id_join_event = :id_join_event AND id_users = :id_users";
        

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id);

        $stmt->bindParam(":id_join_event", $id_join_event);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}