<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Training extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "job_training";

        $this->getConnection();
    }

    /**
     * Get all training
     * @return array
     */
    public function getTraining(): array
    {
        $query = "SELECT * FROM " . $this->table;

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getTrainingById
     * @param int $id
     * @return array
     */
    public function getTrainingById(int $id): array
    {
        //get training info but also providers id and workshop id
        $query = "SELECT * FROM " . $this->table . " WHERE id_job_training = :id";
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $training = $stmt->fetch(PDO::FETCH_ASSOC);

        //get providers id
        $query = "SELECT id_providers, users.name, users.surname FROM join_providers,users WHERE id_job_training = :id AND users.id_users = (SELECT id_users FROM providers WHERE id_providers = join_providers.id_providers)";
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $providers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //get workshop id
        $query = "SELECT workshop.* FROM will_contains_workshop,workshop WHERE id_job_training = :id AND workshop.id_workshop = will_contains_workshop.id_workshop";
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $workshop = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $training['providers'] = $providers;
        $training['workshop'] = $workshop;

        return $training;
    }

    /**
     * saveTraining
     * @param string $name
     * @param float $price
     * @param array $workshop
     * @param array $providers
     * @return bool
     */
    public function saveTraining(string $name, float $price, array $workshop, array $providers): bool
    {
        $query = "INSERT INTO " . $this->table . " (name, price) VALUES (:name, :price)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':price', $price, PDO::PARAM_STR);

        $stmt->execute();

        $id_job_training = $this->_connexion->lastInsertId();

        $query = "INSERT INTO will_contains_workshop (id_job_training, id_workshop) VALUES (:id_job_training, :id_workshop)";

        $stmt = $this->_connexion->prepare($query);

        foreach ($workshop as $id_workshop) {
            $stmt->bindValue(':id_job_training', $id_job_training, PDO::PARAM_INT);
            $stmt->bindValue(':id_workshop', $id_workshop, PDO::PARAM_INT);
            $stmt->execute();
        }

        $query = "INSERT INTO join_providers (id_job_training, id_providers) VALUES (:id_job_training, :id_providers)";

        $stmt = $this->_connexion->prepare($query);

        foreach ($providers as $id_providers) {
            $stmt->bindValue(':id_job_training', $id_job_training, PDO::PARAM_INT);
            $stmt->bindValue(':id_providers', $id_providers, PDO::PARAM_INT);
            $stmt->execute();
        }

        return true;
    }

    /**
     * saveTrainingEdit
     * @param int $id
     * @param string $name
     * @param float $price
     * @param array $workshop
     * @param array $providers
     * @return bool
     */
    public function saveTrainingEdit(int $id, string $name, float $price, array $workshop, array $providers): bool
    {
        $query = "UPDATE " . $this->table . " SET name = :name, price = :price WHERE id_job_training = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':price', $price, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $query = "DELETE FROM will_contains_workshop WHERE id_job_training = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $query = "DELETE FROM join_providers WHERE id_job_training = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $query = "INSERT INTO will_contains_workshop (id_job_training, id_workshop) VALUES (:id_job_training, :id_workshop)";

        $stmt = $this->_connexion->prepare($query);

        foreach ($workshop as $id_workshop) {
            $stmt->bindValue(':id_job_training', $id, PDO::PARAM_INT);
            $stmt->bindValue(':id_workshop', $id_workshop, PDO::PARAM_INT);
            $stmt->execute();
        }

        $query = "INSERT INTO join_providers (id_job_training, id_providers) VALUES (:id_job_training, :id_providers)";

        $stmt = $this->_connexion->prepare($query);

        foreach ($providers as $id_providers) {
            $stmt->bindValue(':id_job_training', $id, PDO::PARAM_INT);
            $stmt->bindValue(':id_providers', $id_providers, PDO::PARAM_INT);
            $stmt->execute();
        }

        return true;
    }

    /**
     * deleteTraining
     * @param int $id
     * @return bool
     */
    public function deleteTraining(int $id): bool
    {
        $query = "DELETE FROM will_contains_workshop WHERE id_job_training = :id";
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $query = "DELETE FROM join_providers WHERE id_job_training = :id";
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $query = "DELETE FROM user_join_job_training WHERE id_job_training = :id";
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        //delete training
        $query = "DELETE FROM " . $this->table . " WHERE id_job_training = :id";
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return true;
    }

    /**
     * addUserToTraining
     * @param int $id_users
     * @param int $id_job_training
     * @return bool
     */
    public function addUserToTraining(int $id_users, int $id_job_training): bool
    {
        $query = "INSERT INTO user_join_job_training (id_users, id_job_training) VALUES (:id_users, :id_job_training)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindValue(':id_users', $id_users, PDO::PARAM_INT);
        $stmt->bindValue(':id_job_training', $id_job_training, PDO::PARAM_INT);

        $stmt->execute();

        return true;
    }

    /**
     * userIsInTraining
     * @param int $id_users
     * @param int $id_job_training
     * @return bool
     */
    public function userIsInTraining(int $id_users, int $id_job_training): bool
    {
        $query = "SELECT * FROM user_join_job_training WHERE id_users = :id_users AND id_job_training = :id_job_training";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindValue(':id_users', $id_users, PDO::PARAM_INT);
        $stmt->bindValue(':id_job_training', $id_job_training, PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            return false;
        }

        return true;
    }

    /**
     * getTrainingOfProvider
     * @param int $id_users
     * @return array
     */
    public function getTrainingOfProvider(int $id_users): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_job_training IN (SELECT id_job_training FROM join_providers WHERE id_providers IN (SELECT id_providers FROM providers WHERE id_users = :id_users))";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindValue(':id_users', $id_users, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getUsersByTraining
     * @param int $id_job_training
     * @return array
     */
    public function getUsersByTraining(int $id_job_training): array
    {
        $query = "SELECT * FROM users WHERE id_users IN (SELECT id_users FROM user_join_job_training WHERE id_job_training = :id_job_training)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindValue(':id_job_training', $id_job_training, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}

?>