<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class RegistrationService extends Model
{

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->getConnection();
    }

    /**
     * Get user info by id
     * @param int $id
     * @return array|bool
     */
    public function getUserInfo(int $id)
    {
        $query = "SELECT id_users, email, name, surname, address, city, country, phone, zip_code, is_banned, sponsor_counter, id_access, creation_date,mail_verified,censure_tchat FROM " . $this->table . " WHERE id_users = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get all home_service request
     * @return array|bool
     */
    public function getAllHomeServiceRequest()
    {
        $query = "SELECT * FROM home_service, users, providers WHERE home_service.id_users = users.id_users AND providers.id_users = users.id_users AND home_service.date > CURRENT_DATE";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }

    /**
     * Get the provider ID for registration
     * @param int $id_providers
     * @param int $id_home_service
     * @return array|bool
     */
    public function registration($id_providers, $id_home_service)
    {
        $query = "INSERT INTO  providers_join_home_service (id_providers, id_home_service) VALUES (:id_providers,:id_home_service)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_providers", $id_providers);

        $stmt->bindParam(":id_home_service", $id_home_service);

        $stmt->execute();
        
    }
}