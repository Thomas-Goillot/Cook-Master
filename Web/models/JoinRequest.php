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
        WHERE providers.verified IS NULL";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    /**
     * Add someone to providers list
     * int id
     * @return array
     */
    public function Add(int $id): array
    {
        $query = "UPDATE providers SET verified = 1 WHERE id_users = :id_users";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Delete someone to providers list
     * @param int $id_users
     * @return array
     */
    public function supp(int $id_users): array
    {
        $query = "UPDATE providers SET verified = 2 WHERE id_users = :id_users";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id_users);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}