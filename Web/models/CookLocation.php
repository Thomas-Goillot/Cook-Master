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
     * Get all cookLocation
     * @return array
     */
    public function getAllcookLocation(): array
    {
        $query = "SELECT * FROM " . $this->table;

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}