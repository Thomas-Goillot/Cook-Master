<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class EventsPresentation extends Model
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
     * Get all events where place and date is ok
     * @return array
     */
    public function getAllEventsAvailable(): array
    {
        $query = "SELECT * FROM " . $this->table ." WHERE date_end > NOW() AND place > (SELECT COUNT(id_join_event) FROM join_event WHERE id_event = event.id_event)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get id of event
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


    public function getEventBookedPlace(int $id)
    {
        $query = "SELECT COUNT(id_join_event) FROM join_event WHERE id_event = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}