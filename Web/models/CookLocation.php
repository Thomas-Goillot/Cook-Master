<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class cookLocation extends Model
{
     /**
     * cookLocation constructor.
     */
    public function __construct()
    {
        $this->table = "location";

        $this->getConnection();
    }

      /**
     * Get all cookLocation with location info and images
     * @return array
     */
    public function getAllCookLocationsWithInfo(): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE available_to_rental = 1";

        $stmt = $this->_connexion->prepare($query);
        $stmt->execute();
        $cookLocations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = array();

        foreach ($cookLocations as $cookLocation) {
            $location = $this->getLocationInfoById($cookLocation["id_location"]);
            $cookLocation["location_info"] = $location;
            $result[] = $cookLocation;
        }

        return $result;
    }

    /**
     * Get location information by ID
     * @param int $id
     * @return array
     */
    public function getLocationInfoById(int $id): array
    {
        $sql = "SELECT * FROM location WHERE id_location = :id_location";

        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindParam(':id_location', $id);
        $stmt->execute();
        $location = $stmt->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT id_opening_hours FROM opens_at WHERE id_location = :id_location";

        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindParam(':id_location', $location['id_location']);
        $stmt->execute();
        $opening_hours = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $location['opening_hours'] = array();

        foreach ($opening_hours as $opening_hour) {
            $sql = "SELECT * FROM opening_hours WHERE id_opening_hours = :id_opening_hours";

            $stmt = $this->_connexion->prepare($sql);
            $stmt->bindParam(':id_opening_hours', $opening_hour['id_opening_hours']);
            $stmt->execute();
            $opening_hours = $stmt->fetch(PDO::FETCH_ASSOC);
            $location['opening_hours'][] = $opening_hours;
        }

        $sql = "SELECT * FROM images_location WHERE id_location = :id_location";

        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindParam(':id_location', $location['id_location']);
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $location['images'] = $images;

        return $location;
    }

    
}