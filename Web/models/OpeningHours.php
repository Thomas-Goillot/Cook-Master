<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class OpeningHours extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "opening_hours";

        $this->getConnection();
    }

    /**
     * Add a new opening hours to the database and return the id
     * @param string $opening_day
     * @param string $opening_hours
     * @param string $closing_hours
     * @return int
     */
    public function addOpeningHours(string $opening_day, string $opening_hours, string $closing_hours): int
    {
        $sql = "INSERT INTO " . $this->table . " (opening_day, opening_hours, closing_hours) VALUES (:opening_day, :opening_hours, :closing_hours)";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindParam(':opening_day', $opening_day);
        $stmt->bindParam(':opening_hours', $opening_hours);
        $stmt->bindParam(':closing_hours', $closing_hours);

        $stmt->execute();

        return $this->_connexion->lastInsertId();
    }

    /**
     * Add a new opening hours to a location
     * @param int $id_location
     * @param int $id_opening_hours
     * @return bool
     */
    public function addOpensAt(int $id_location, int $id_opening_hours): bool
    {
        $sql = "INSERT INTO opens_at (id_location, id_opening_hours) VALUES (:id_location, :id_opening_hours)";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindParam(':id_location', $id_location);
        $stmt->bindParam(':id_opening_hours', $id_opening_hours);

        $stmt->execute();

        return true;
    }



}
