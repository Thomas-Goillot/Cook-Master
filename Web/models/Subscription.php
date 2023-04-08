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
        $this->table = "subscription";

        $this->getConnection();
    }

    /**
     * Get all subscription
     *
     * @return array
     */
    public function getAllSubscription(): array
    {
        $query = "SELECT * FROM ".$this->table."";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all subscription
     *
     * @return array
     */
    public function getAllSubscriptionNumberOfSubscribe(): array
    {
        $query = "SELECT s.*, 
        COUNT(st.id_users) AS subscription_total,
        COUNT(CASE WHEN st.date_of_buy >= DATE_SUB(NOW(), INTERVAL 1 MONTH) THEN st.id_users END) AS subscription_this_month
        FROM subscription s
        LEFT JOIN subscribe_to st ON s.id_subscription = st.id_subscription
        GROUP BY s.id_subscription

        ";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all subscription Option
     *
     * @return array
     */
    public function getAllSubscriptionOption(): array
    {
        $this->table = "subscription_option";
        $query = "SELECT * FROM ".$this->table."";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all subscription Rewards
     * @return array
     */
    public function getAllSubscriptionRewards(): array
    {
        $this->table = "rewards";
        $query = "SELECT * FROM ".$this->table."";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all subscription Shipping Type
     * @return array
     */
    public function getAllSubscriptionShippingType(): array
    {
        $this->table = "shipping_type";
        $query = "SELECT * FROM ".$this->table."";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all subscription info
     * @return array
     */
    public function getAllSubscriptionInfo(): array
    {
        $query = "SELECT sub.*, 
       rew.name as rewards_name, rew.description as rewards_description, rew.amount as rewards_amount,rew.currency as rewards_currency, rew.nb_new_subscribers as rewards_nb_new_subscribers,
       rnb.amount as renewal_bonus_amount, rnb.currency as renewal_bonus_currency, rnb.payment_periodicity as renewal_bonus_payment_periodicity
        FROM subscription sub
        LEFT JOIN sponsors spo ON sub.id_subscription = spo.id_subscription
        LEFT JOIN rewards rew ON spo.id_rewards = rew.id_rewards
        LEFT JOIN renewal_bonus rnb ON sub.id_renewal_bonus = rnb.id_renewal_bonus 
        ORDER BY sub.id_subscription;";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();
        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($response as $key => $value) {
            $response[$key]['rewards'] = [
                'name' => $value['rewards_name'],
                'description' => $value['rewards_description'],
                'amount' => $value['rewards_amount'],
                'currency' => $value['rewards_currency'],
                'nb_new_subscribers' => $value['rewards_nb_new_subscribers']
            ];

            $response[$key]['renewal_bonus'] = [
                'amount' => $value['renewal_bonus_amount'],
                'currency' => $value['renewal_bonus_currency'],
                'payment_periodicity' => $value['renewal_bonus_payment_periodicity']
            ];
            
            $query = "SELECT * FROM subscription_option";
            $stmt = $this->_connexion->prepare($query);
            $stmt->execute();
            $allSubscriptionOption = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $query = "SELECT * FROM give_access_to WHERE id_subscription = :id_subscription";
            $stmt = $this->_connexion->prepare($query);
            $stmt->bindParam(':id_subscription', $value['id_subscription']);
            $stmt->execute();
            $subscriptionOption = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($allSubscriptionOption as $key2 => $value2) {
                $response[$key]['subscription_option'][$key2] = $value2;
                $response[$key]['subscription_option'][$key2]['selected'] = false;
                foreach($subscriptionOption as $key3 => $value3) {
                    if($value2['id_subscription_option'] == $value3['id_subscription_option']) {
                        $response[$key]['subscription_option'][$key2]['selected'] = true;
                    }
                }
            }

            $query = "SELECT * FROM shipping_type WHERE id_shipping_type IN (SELECT id_shipping_type FROM deliver_to WHERE id_subscription = :id_subscription)";
            $stmt = $this->_connexion->prepare($query);
            $stmt->bindParam(':id_subscription', $value['id_subscription']);
            $stmt->execute();
            $response[$key]['shipping_type'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        }


        return $response;
    }

    /**
     * Get all subscription info By Id
     * @param int $id_subscription
     * @return array
     */
    public function getAllSubscriptionInfoById(int $id_subscription): array
    {
        $query = "SELECT sub.*, 
       rew.name as rewards_name, rew.description as rewards_description, rew.amount as rewards_amount,rew.currency as rewards_currency, rew.nb_new_subscribers as rewards_nb_new_subscribers,
       rnb.amount as renewal_bonus_amount, rnb.currency as renewal_bonus_currency, rnb.payment_periodicity as renewal_bonus_payment_periodicity
        FROM subscription sub
        LEFT JOIN sponsors spo ON sub.id_subscription = spo.id_subscription
        LEFT JOIN rewards rew ON spo.id_rewards = rew.id_rewards
        LEFT JOIN renewal_bonus rnb ON sub.id_renewal_bonus = rnb.id_renewal_bonus 
        WHERE sub.id_subscription = :id_subscription
        ORDER BY sub.id_subscription
        ;";

        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':id_subscription', $id_subscription);
        $stmt->execute();
        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($response as $key => $value) {
            $response[$key]['rewards'] = [
                'name' => $value['rewards_name'],
                'description' => $value['rewards_description'],
                'amount' => $value['rewards_amount'],
                'currency' => $value['rewards_currency'],
                'nb_new_subscribers' => $value['rewards_nb_new_subscribers']
            ];

            $response[$key]['renewal_bonus'] = [
                'amount' => $value['renewal_bonus_amount'],
                'currency' => $value['renewal_bonus_currency'],
                'payment_periodicity' => $value['renewal_bonus_payment_periodicity']
            ];

            $query = "SELECT * FROM subscription_option";
            $stmt = $this->_connexion->prepare($query);
            $stmt->execute();
            $allSubscriptionOption = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $query = "SELECT * FROM give_access_to WHERE id_subscription = :id_subscription";
            $stmt = $this->_connexion->prepare($query);
            $stmt->bindParam(':id_subscription', $value['id_subscription']);
            $stmt->execute();
            $subscriptionOption = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($allSubscriptionOption as $key2 => $value2) {
                $response[$key]['subscription_option'][$key2] = $value2;
                $response[$key]['subscription_option'][$key2]['selected'] = false;
                foreach ($subscriptionOption as $key3 => $value3) {
                    if ($value2['id_subscription_option'] == $value3['id_subscription_option']) {
                        $response[$key]['subscription_option'][$key2]['selected'] = true;
                    }
                }
            }


            $query = "SELECT * FROM shipping_type WHERE id_shipping_type";
            $stmt = $this->_connexion->prepare($query);
            $stmt->execute();

            $shippingType = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $query = "SELECT id_shipping_type FROM deliver_to WHERE id_subscription = :id_subscription";
            $stmt = $this->_connexion->prepare($query);
            $stmt->bindParam(':id_subscription', $value['id_subscription']);
            $stmt->execute();
            $deliverTo = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($shippingType as $key2 => $value2) {
                $response[$key]['shipping_type'][$key2] = $value2;
                $response[$key]['shipping_type'][$key2]['selected'] = false;
                foreach ($deliverTo as $key3 => $value3) {
                    if ($value2['id_shipping_type'] == $value3['id_shipping_type']) {
                        $response[$key]['shipping_type'][$key2]['selected'] = true;
                    }
                }
            }
        }


        return $response;
    }




}
