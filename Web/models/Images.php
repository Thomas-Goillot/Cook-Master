<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Images extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "images_location";

        $this->getConnection();
    }

    /**
     * Add a new image to the database
     * @param string $image
     * @param int $id_location
     * @return void
     */
    public function addLocation(string $image, int $id_location): void
    {
        $sql = "INSERT INTO " . $this->table . " (image, id_location) VALUES (:image, :id_location)";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':id_location', $id_location);

        $stmt->execute();
    }
}
