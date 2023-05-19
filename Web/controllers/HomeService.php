<?php

namespace Controllers;

use App\Controller;

class HomeService extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "homeService/index"; 
   
    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

    }
    
    /**
     * Display the joinRequest page
     * @return void
     */ 
    public function index(): void
    {
        $this->loadModel('User');

        $user = $this->_model->getUserInfo($_SESSION['user']['id_users']);

        $this->loadModel("HomeService");

        $this->setJsFile(array('location.js'));
        
        $this->setCssFile(array('css/location/location.css'));

        $page_name = array("Prestation à domicile" => "homeService/index");

        $address = $user["address"] .= ", ";

        $address .= $user["city"];

        $address  .= " ";

        $address .= $user["zip_code"];

        $this->render("homeService/index", compact('address','user','page_name'), DASHBOARD);
    }
   
}
