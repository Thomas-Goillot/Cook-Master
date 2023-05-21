<?php

namespace Controllers;

use App\Controller;

class RegistrationService extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "providers/registrationService"; 
   
    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

    }
    
    /**
     * Display the Home service page
     * @return void
     */ 
    public function index(): void
    {
        $this->loadModel('User');

        $id_users = $this->getUserId();

        $user = $this->_model->getUserInfo($_SESSION['user']['id_users']);

        $this->loadModel('RegistrationService');

        $getAllHomeServiceRequest = $this->_model->getAllHomeServiceRequest();

        $page_name = array("Inscription aux prestations" => "providers/registrationService");

        $this->render("providers/registrationService", compact('page_name','getAllHomeServiceRequest'), DASHBOARD);
    }
}