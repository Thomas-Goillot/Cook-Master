<?php

namespace Models;

use PDO;
use App\Model;

class User extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "users";

        $this->getConnection();
    }

    /**
     * Get user info by id
     * @param int $id
     * @return array
     */
    public function getInfo($id): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
