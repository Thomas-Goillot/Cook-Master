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
    
    /**
     * Get providers list u know
     *
     * @return array
     */
    public function getAllProvidersValidate(): array
    {
        $query = "SELECT users.name, 
        users.surname, 
        users.phone, 
        users.email, 
        users.id_users, 
        providers.siret, 
        providers_files.file, 
        providers_images.image, 
        providers_type.type 
        FROM providers 
        LEFT JOIN users ON providers.id_users = users.id_users 
        LEFT JOIN add_files ON providers.id_providers = add_files.id_providers 
        LEFT JOIN providers_files ON add_files.id_providers_files = providers_files.id_providers_files 
        LEFT JOIN add_images ON providers.id_providers = add_images.id_providers 
        LEFT JOIN providers_images ON add_images.id_providers_images = providers_images.id_providers_images 
        LEFT JOIN of_type ON providers.id_providers = of_type.id_providers 
        LEFT JOIN providers_type ON of_type.id_providers_type = providers_type.id_providers_type 
        WHERE providers.verified = 1";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}