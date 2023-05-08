<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Join extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "provider";

        $this->getConnection();
    }


    /**
     * Join us
     * @param int $Siret
     * @param string $Cv
     * @param string $Photo
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


}