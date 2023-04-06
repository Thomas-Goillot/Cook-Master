<?php

namespace Controllers;

use App\Controller;

class Users extends Controller{


    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "users/profil";


    public function __construct()
    {
        if ($this->isLogged() === false ) {
            $this->redirect('../home');
            exit();
        }
    }

    /**
     * Display the user profil page
     *
     * @return void
     */
    public function profil():void{

        $this->loadModel('User');

        $user = $this->_model->getUserInfo($_SESSION['user']['id_users']);

        $subscription = $this->_model->getUserSubscriptionName($_SESSION['user']['id_users']);
        $page_name = array("Profil" => $this->default_path);

        $this->render($this->default_path, compact('user', 'subscription', 'page_name'), DASHBOARD);
    }
    
}