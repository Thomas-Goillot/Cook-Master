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
     * Get all subscription Renewal Bonus
     * @return array
     */
    public function getAllSubscriptionRenewalBonus(): array
    {
        $query = "SELECT * FROM renewal_bonus";

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
        $query = "SELECT * FROM rewards";

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
        $query = "SELECT * FROM shipping_type";

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

    /**
     * Create subscription
     * @param string $subscriptionName
     * @param int $subscriptionAccessToLessons
     * @param float $subscriptionPriceMonthly
     * @param float $subscriptionPriceYearly
     * @param int $idRenewalBonus
     * @param int $subscriptionActive
     * @param array $subscriptionOption
     * @param array $shippingType
     * @param array $rewards
     * @param string $icon
     * @return bool
     */
    public function createSubscription(string $subscriptionName, int $subscriptionAccessToLessons, float $subscriptionPriceMonthly, float $subscriptionPriceYearly, int $idRenewalBonus, int $subscriptionActive, array $subscriptionOption, array $shippingType, array $rewards, string $icon): bool
    {
        try{
            $query = "INSERT INTO subscription (name, access_to_lessons, price_monthly, price_yearly, id_renewal_bonus, is_active, icon) VALUES (:name, :access_to_lessons, :price_monthly, :price_yearly, :id_renewal_bonus, :is_active, :icon)";
            $stmt = $this->_connexion->prepare($query);
            $stmt->bindParam(':name', $subscriptionName);
            $stmt->bindParam(':access_to_lessons', $subscriptionAccessToLessons);
            $stmt->bindParam(':price_monthly', $subscriptionPriceMonthly);
            $stmt->bindParam(':price_yearly', $subscriptionPriceYearly);
            $stmt->bindParam(':id_renewal_bonus', $idRenewalBonus);
            $stmt->bindParam(':is_active', $subscriptionActive);
            $stmt->bindParam(':icon', $icon);
            $stmt->execute();
            $idSubscription = $this->_connexion->lastInsertId();

            foreach ($subscriptionOption as $key => $value) {
                $query = "INSERT INTO give_access_to (id_subscription, id_subscription_option) VALUES (:id_subscription, :id_subscription_option)";
                $stmt = $this->_connexion->prepare($query);
                $stmt->bindParam(':id_subscription', $idSubscription);
                $stmt->bindParam(':id_subscription_option', $value);
                $stmt->execute();
            }

            foreach ($shippingType as $key => $value) {
                $query = "INSERT INTO deliver_to (id_subscription, id_shipping_type) VALUES (:id_subscription, :id_shipping_type)";
                $stmt = $this->_connexion->prepare($query);
                $stmt->bindParam(':id_subscription', $idSubscription);
                $stmt->bindParam(':id_shipping_type', $value);
                $stmt->execute();
            }

            foreach ($rewards as $key => $value) {
                $query = "INSERT INTO sponsors(id_subscription, id_rewards) VALUES (:id_subscription, :id_rewards)";
                $stmt = $this->_connexion->prepare($query);
                $stmt->bindParam(':id_subscription', $idSubscription);
                $stmt->bindParam(':id_rewards', $value);
                $stmt->execute();
            }

            return true;

        }catch (PDOException $e){
            return false;

        }
    }

    /**
     * Update subscription
     * @param int $subscriptionId
     * @param string $subscriptionName
     * @param int $subscriptionAccessToLessons
     * @param float $subscriptionPriceMonthly
     * @param float $subscriptionPriceYearly
     * @param int $subscriptionActive
     * @return bool
     */
    public function updateSubscription(int $subscriptionId, string $subscriptionName, int $subscriptionAccessToLessons, float $subscriptionPriceMonthly, float $subscriptionPriceYearly, int $subscriptionActive): bool
    {
        try{
            $query = "UPDATE subscription SET name = :name, access_to_lessons = :access_to_lessons, price_monthly = :price_monthly, price_yearly = :price_yearly, is_active = :is_active WHERE id_subscription = :id_subscription";
            $stmt = $this->_connexion->prepare($query);
            $stmt->bindParam(':id_subscription', $subscriptionId);
            $stmt->bindParam(':name', $subscriptionName);
            $stmt->bindParam(':access_to_lessons', $subscriptionAccessToLessons);
            $stmt->bindParam(':price_monthly', $subscriptionPriceMonthly);
            $stmt->bindParam(':price_yearly', $subscriptionPriceYearly);
            $stmt->bindParam(':is_active', $subscriptionActive);
            $stmt->execute();
            return true;
        }
        catch (PDOException $e){
            return false;
        }

    }



}
