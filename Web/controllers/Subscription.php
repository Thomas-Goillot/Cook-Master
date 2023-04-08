<?php

namespace Controllers;

use App\Controller;

class Subscription extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "subscription";

    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

        $this->loadModel('User');

        $id_access = $this->_model->getAll();

        $id_access = (int) $id_access[0]['id_access'];

        if ($this->isAdmin($id_access) === false) {
            $this->redirect('../home');
            exit();
        }
        
    }

    /**
     * Edit a subscription
     * @return void
     */
    public function edit(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_subscription = (int) $params[0];        

        $this->loadModel('Subscription');

        $subscriptionAllInfo = $this->_model->getAllSubscriptionInfoById($id_subscription);

        if($subscriptionAllInfo[0]['is_active'] == 1) {
            $subscriptionAllInfo[0]['is_active'] = 'checked';
        } else {
            $subscriptionAllInfo[0]['is_active'] = '';
        }
        

        $page_name = array("Admin" => "", "Abonnements" => "admin/subscription", "Modification de ". $subscriptionAllInfo[0]['name']."" => "subscription/edit/$id_subscription");

        $this->render('subscription/edit', compact('subscriptionAllInfo','page_name'), DASHBOARD, '../../');

    }

    /**
     * Update a subscription
     * @return void
     */
    public function update(): void
    {
        /* 
        array(6) { ["SubscriptionName"]=> string(6) "Master" ["SubscriptionOptions"]=> array(5) { [0]=> string(1) "2" [1]=> string(1) "3" [2]=> string(1) "4" [3]=> string(1) "5" [4]=> string(1) "6" } ["SubscriptionShippingType"]=> array(2) { [0]=> string(1) "1" [1]=> string(1) "2" } ["SubscriptionAccessToLessons"]=> string(2) "-1" ["SubscriptionPriceMonthly"]=> string(5) "19.00" ["SubscriptionPriceYearly"]=> string(6) "220.00" } */

        if(!isset($_POST)){
            
        }












        var_dump($_POST);
    }

}