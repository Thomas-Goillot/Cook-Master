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

    /**
     * 
     * @return array
     */
    public function getAllLocationWithOpeningHours(): array
    {
       //get all location
        $sql = "SELECT * FROM " . $this->table;

        $stmt = $this->_connexion->prepare($sql);

        $stmt->execute();

        $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //récupére les horaires de chaque location en passant par la table opens_at
        foreach ($locations as $key => $location) {
            $sql = "SELECT id_opening_hours FROM opens_at WHERE id_location = :id_location";

            $stmt = $this->_connexion->prepare($sql);

            $stmt->bindParam(':id_location', $location['id_location']);

            $stmt->execute();

            $opening_hours = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $locations[$key]['opening_hours'] = array();

            foreach ($opening_hours as $opening_hour) {
                $sql = "SELECT * FROM opening_hours WHERE id_opening_hours = :id_opening_hours";

                $stmt = $this->_connexion->prepare($sql);

                $stmt->bindParam(':id_opening_hours', $opening_hour['id_opening_hours']);

                $stmt->execute();

                $opening_hours = $stmt->fetch(PDO::FETCH_ASSOC);

                $locations[$key]['opening_hours'][] = $opening_hours;
            }
        }

        return $locations;

    }

    /**
     * @param int $id
     * @return array
     */
    public function getLocationInfoById(int $id): array
    {
        $sql = "SELECT * FROM " . $this->table ." WHERE id_location = :id_location";

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