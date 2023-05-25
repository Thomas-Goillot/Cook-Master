<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class UserSubscription extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "subscribe_to";

        $this->getConnection();
    }

    public function checkUserAsSubscribe(int $id_users, int $id_subscription): bool
    {
        $sql = "SELECT * FROM $this->table WHERE id_users = :id_user AND id_subscription = :id_subscription";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindValue(':id_user', $id_users);
        $stmt->bindValue(':id_subscription', $id_subscription);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            return true;
        }

        return false;
    }

    public function updateSubscriptionToUser(int $id_users, int $id_subscription, int $periodicity): void
    {
        $sql = "UPDATE $this->table SET periodicity = :periodicity, id_subscription = :id_subscription, date_of_buy = NOW() WHERE id_users = :id_user";

        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindValue(':id_user', $id_users);
        $stmt->bindValue(':id_subscription', $id_subscription);
        $stmt->bindValue(':periodicity', $periodicity);

        $stmt->execute();
    }



}
