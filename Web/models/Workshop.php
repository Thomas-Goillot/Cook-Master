<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class workshop extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "workshop";

        $this->getConnection();
    }

    /**
     * Get all workshop
     * @return array
     */
    public function getAllWorkshop(): array
    {
        $query = "SELECT * FROM " . $this->table . "";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Get all workshop where place and date is ok
     * @return array
     */
    public function getAllWorkshopAvailable(): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE date_end > NOW() AND nb_place > 0";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    /**
     * Get id of workshop
     * @return array
     */
    public function getWorkshopById(int $id): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_workshop = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Add a workshop
     * @param string $name
     * @param string $description
     * @param string $image
     * @param float $price
     * @param int $available
     * @param string $date_start
     * @param string $date_end
     * @return int
     */
    public function addworkshop(string $description, string $name,  string $image, string $image2, string $image3, float $price, string $date_start, string $date_end, int $nb_place, int $id_location): int
    {
        $query = "INSERT INTO " . $this->table .  "(description, name, image, image2, image3, price, date_start, date_end, nb_place, id_location) VALUES (:description, :name, :image, :image2, :image3, :price, :date_start, :date_end, :nb_place, :id_location)";

        $data = array(
            ":description" => $description,
            ":name" => $name,
            ":image" => $image,
            ":image2" => $image2,
            ":image3" => $image3,
            ":price" => $price,
            ":date_start" => $date_start,
            ":date_end" => $date_end,
            ":nb_place" => $nb_place,
            ":id_location" => $id_location
        );

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute($data);

        return $this->_connexion->lastInsertId();
    }


    /**
     * Get edit workshop
     * @return void
     */
    public function editWorkshop(string $name, string $description, string $image, int $price, int $available, string $date_start, string $date_end, int $id_worshop): void
    {
        $query = "UPDATE " . $this->table . " SET name = :name, description = :description, image = :image, price = :price, available = :available, date_start = :date_start, date_end = :date_end WHERE id_equipment = :id_equipment";

        $data = array(
            ":name" => $name,
            ":description" => $description,
            ":image" => $image,
            ":price" => $price,
            ":available" => $available,
            ":date_start" => $date_start,
            ":date_end" => $date_end,
            ":id_worshop" => $id_worshop
        );

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute($data);
    }

    /**
     * delete workshop from workshop
     * @return bool
     */
    public function deleteProduct(int $id): bool
    {

        $query = "DELETE FROM " . $this->table . " WHERE id_equipment = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    /**
     * 
     * @return array
     */
    public function getAllLocationWithOpeningHours(): array
    {
        //get all location
        $sql = "SELECT * FROM location";

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
        $sql = "SELECT * FROM " . $this->table . " WHERE id_location = :id_location";

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
     * add addWorkshopProduct
     * @param int $id_equipment
     * @param int $id_workshop
     * @return array
     */
    public function addWorkshopProduct(int $id_equipment, int $id_workshop): void
    {
        $query = "INSERT INTO use_equipment_workshop (id_equipment, id_workshop) VALUES (:id_equipment, :id_workshop)";

        $data = array(
            ":id_equipment" => $id_equipment,
            ":id_workshop" => $id_workshop
        );

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute($data);
    }


    /**
     *  getWorkshopLocation
     *  @param int $id_location
     * @return array
     */
    public function getWorkshopLocation(int $id_location): string
    {
        $query = "SELECT * FROM location WHERE id_location = :id_location";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_location", $id_location);

        $stmt->execute();

        $location = $stmt->fetch(PDO::FETCH_ASSOC);

        return $location['address'];
    }
}
