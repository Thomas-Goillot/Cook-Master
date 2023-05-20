<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class HomeService extends Model
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
     * Get all entrances without ingredients
     * @return array
     */
    public function getAllEntrancesWithoutIngredients(): array
    {
        $query = "SELECT * FROM recipes WHERE type = 1";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all dishes without ingredients
     * @return array
     */
    public function getAllDishesWithoutIngredients(): array
    {
        $query = "SELECT * FROM recipes WHERE type = 2";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    /**
     * Get all desserts without ingredients
     * @return array
     */
    public function getAllDessertsWithoutIngredients(): array
    {
        $query = "SELECT * FROM recipes WHERE type = 3";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Send request of home service
     * @param int $nb_places
     * @param int $type_home_services
     * @param int $type_equipment
     * @param int $type_nourriture
     * @param int $id_users
     * @param int $id_recipes
     * @param int $id_recipes_1
     * @param int $id_recipes_2
     * @param $date
     * @return array
     */
    public function sendRequest($nb_places, $type_home_services, $type_equipment, $type_nourriture, $id_users, $id_recipes, $id_recipes_1, $id_recipes_2, $date)
    {
        $query = "INSERT INTO home_service 
        (type_home_service, type_equipment, type_nourriture, nb_places, id_users, id_recipes, id_recipes_1, id_recipes_2, date)
        VALUES (:type_home_service, :type_equipment, :type_nourriture, :nb_places, :id_users, :id_recipes, :id_recipes_1, :id_recipes_2, :date)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":type_home_service", $type_home_services);
        $stmt->bindParam(":type_equipment", $type_equipment);
        $stmt->bindParam(":type_nourriture", $type_nourriture);
        $stmt->bindParam(":nb_places", $nb_places);
        $stmt->bindParam(":id_users", $id_users);
        $stmt->bindParam(":id_recipes", $id_recipes);
        $stmt->bindParam(":id_recipes_1", $id_recipes_1);
        $stmt->bindParam(":id_recipes_2", $id_recipes_2);
        $stmt->bindParam(":date", $date);

        $stmt->execute();
    }

    /**
     * Get all home services
     * @param int $id_users
     * @return array
     */
    public function getAllHomeServices(int $id_users)
    {
        $query = "SELECT * FROM home_service WHERE id_users = :id_users";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id_users);

        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Delete a home service
     * @param int $id_home_service
     * @return array
     */
    public function deleteService($id_home_service)
    {
        $query = "DELETE FROM `home_service` WHERE id_home_service = :id_home_service";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_home_service", $id_home_service);

        $stmt->execute();
    }

}