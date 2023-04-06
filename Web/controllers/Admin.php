<?php

namespace Controllers;

use App\Controller;

class Admin extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "admin/users";

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
     * Display the user profil page
     *
     * @return void
     */
    public function users(): void
    {

        $users = $this->_model->getAll();

        $page_name = "Utilisateurs";

        $this->render($this->default_path, compact('users', 'page_name'), DASHBOARD);
    }

    /**
     * Display the Subscription page
     *
     * @return void
     */
    public function subscription(): void
    {
            
        $this->loadModel('Subscription');

        $subscriptionsNumber = $this->_model->getAllSubscriptionNumberOfSubscribe();
        $subscriptionOption = $this->_model->getAllSubscriptionOption();
        $rewards = $this->_model->getAllSubscriptionRewards();
        $shippingTypes = $this->_model->getAllSubscriptionShippingType();
        $subscriptionAllInfo = $this->_model->getAllSubscriptionInfo();

        $page_name = "Abonnements";

        $this->render('admin/subscription', compact('subscriptionsNumber', 'subscriptionOption', 'rewards', 'subscriptionAllInfo', 'shippingTypes', 'subscriptionOptionId', 'subscriptionOptionInIt', 'page_name'), DASHBOARD);
    }

}
/* 
    echo "<li>
    <i class=\"text-danger fas fa-times\"></i> 
    " . ucfirst(strtolower($feature['name'])) . "
    </li>";

    echo "<li>
    <i class=\"text-success fas fa-check\"></i> " . ucfirst(strtolower($subscription['subscription_option'][$i]['name'])) . "
    </li>

*/