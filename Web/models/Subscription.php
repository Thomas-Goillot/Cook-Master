<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Subscription extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "subscriptions";

        $this->getConnection();
    }

    public function getSubscriptions(): array
    {
        $query = "SELECT s.*, sp.*, r.*, st.*, d.*, a.*, so.*
                FROM subscription s
                JOIN subscription_option so ON s.id_subscription_option = so.id_subscription_option
                JOIN rewards r ON s.id_rewards = r.id_rewards
                JOIN shipping_type st ON r.id_shipping_type = st.id_shipping_type
                JOIN providers p ON r.id_providers = p.id_providers
                JOIN relay_point d ON p.id_relay_point = d.id_relay_point
                JOIN access a ON s.id_access = a.id_access";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
