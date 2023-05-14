<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class JoinRequest extends Model
{

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->getConnection();
    }

    /**
     * Get all subscriptions
     * @return array
     */
    public function getAllRequest(): array
    {
        $query = "SELECT users.name, users.surname, users.phone, users.email, users.id_users, providers.siret, providers_files.file, providers_images.image FROM providers 
        LEFT JOIN users ON providers.id_users = users.id_users 
        LEFT JOIN add_files ON providers.id_providers = add_files.id_providers 
        LEFT JOIN providers_files ON add_files.id_providers_files = providers_files.id_providers_files 
        LEFT JOIN add_images ON providers.id_providers = add_images.id_providers 
        LEFT JOIN providers_images ON add_images.id_providers_images = providers_images.id_providers_images";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}