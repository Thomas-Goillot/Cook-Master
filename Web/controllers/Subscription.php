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

        




        $page_name = array("Admin" => "", "Abonnements" => "admin/subscription", "Modifier un abonnement" => "subscription/edit/$id_subscription");

        $this->render('subscription/edit', compact('page_name'), DASHBOARD, '../../');

    }

}