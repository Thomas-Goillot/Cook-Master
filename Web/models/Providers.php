<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Providers extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "is_providers";

        $this->getConnection();
    }

    /**
     * Get chefs image from is_providers and name from users
     *
     * @return array
     */
    public function getAllChefsImages(): array
    {
        $query = "SELECT is_providers.image, is_providers.description, users.name, users.surname FROM " . $this->table . " INNER JOIN users ON is_providers.id_users = users.id_users WHERE is_providers.id_providers = 1";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
    