<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class CookLocation extends Model
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



     /**
     * reservationCookLocation
     * @param int $id_workshop
     * @param int $id_users
     * 
     * @return void
     */
    public function reservationCookLocation( int $id_users, int $id_location, string $start_rental, string $end_rental, int $type)
    {
        $query = "INSERT INTO rent_location (id_users,id_location,start_rental,date_reservation,end_rental,type) VALUES (:id_users, :id_location,:start_rental,NOW(),:end_rental, :type)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id_users);
        $stmt->bindParam(":id_location", $id_location);
        $stmt->bindParam(":start_rental", $start_rental);
        $stmt->bindParam(":end_rental", $end_rental);
        $stmt->bindParam(":type", $type);

        $stmt->execute();

        return $this->_connexion->lastInsertId();
    }

    /**
     * getRentLocationInfo
     * status = 0
     * @param int $idUsers
     * @param int @idLocation
     * @return array
     */

    public function getRentLocationInfo(int $idUsers, int $idLocation): array
    {
        $query = "SELECT * FROM rent_location WHERE id_users = :id_users AND id_location = :id_location AND status = 0";

        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(":id_users", $idUsers);
        $stmt->bindParam(":id_location", $idLocation);
        $stmt->execute();
        $rentLocation = $stmt->fetch(PDO::FETCH_ASSOC);

        return $rentLocation;
    }
    
    /**
     * updateStatus
     * @param int $idRentLocation
     * @param int $idUsers
     * @return bool
     */
    public function updateStatus(int $idRentLocation, int $idUsers): bool
    {
        $query = "UPDATE rent_location SET status = 1 WHERE id_rent_location = :id_rent_location AND id_users = :id_users";

        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(":id_rent_location", $idRentLocation);
        $stmt->bindParam(":id_users", $idUsers);
        

        if($stmt->execute())
        {
            return true;
        }
        
        return false;

    }
    
    

    
}