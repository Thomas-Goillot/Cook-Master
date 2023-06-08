<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Stats extends Model
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
    public function getNumberOfSubscriptionsByDate(): array
    {
        $query = "SELECT COUNT(CASE WHEN MONTH(creation_date) = 1 THEN 1 END) AS janvier,
        COUNT(CASE WHEN MONTH(creation_date) = 2 THEN 1 END) AS fevrier,
        COUNT(CASE WHEN MONTH(creation_date) = 3 THEN 1 END) AS mars,
        COUNT(CASE WHEN MONTH(creation_date) = 4 THEN 1 END) AS avril,
        COUNT(CASE WHEN MONTH(creation_date) = 5 THEN 1 END) AS mai,
        COUNT(CASE WHEN MONTH(creation_date) = 6 THEN 1 END) AS juin,
        COUNT(CASE WHEN MONTH(creation_date) = 7 THEN 1 END) AS juillet,
        COUNT(CASE WHEN MONTH(creation_date) = 8 THEN 1 END) AS aout,
        COUNT(CASE WHEN MONTH(creation_date) = 9 THEN 1 END) AS septembre,
        COUNT(CASE WHEN MONTH(creation_date) = 10 THEN 1 END) AS octobre,
        COUNT(CASE WHEN MONTH(creation_date) = 11 THEN 1 END) AS novembre,
        COUNT(CASE WHEN MONTH(creation_date) = 12 THEN 1 END) AS decembre
        FROM users";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    }
    
    /**
     * Get all subscriptions of type
     * @return array
     */
    public function getCountSubscriptions(): array
    {
        $query = "SELECT id_subscription, COUNT(*) AS count FROM subscribe_to GROUP BY id_subscription";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Count all starters
     * @return array
     */
    public function CountStarters(): array
    {
        $query = "SELECT COUNT(*) FROM `recipes` WHERE type = 1";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Count all dishes
     * @return array
     */
    public function CountDishes(): array
    {
        $query = "SELECT COUNT(*) FROM `recipes` WHERE type = 2";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Count all desserts
     * @return array
     */
    public function CountDesserts(): array
    {
        $query = "SELECT COUNT(*) FROM `recipes` WHERE type = 3";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}