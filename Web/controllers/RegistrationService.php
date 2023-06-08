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

        $page_name = array("Inscription aux prestations" => "registrationService");

        $this->render("providers/registrationService", compact('page_name','getAllHomeServiceRequest'), DASHBOARD);
    }

    /**
     * Register a provider to a home service request
     * @return void
     */ 
    public function registration(): void
    {
        $defaultFallBack = "../index";

        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect($defaultFallBack);
            exit();
        }

        $id_providers = (int) $params[0];

        $id_home_service = (int) $params[1];
        
        $this->loadModel('RegistrationService');

        $this->_model->registration($id_providers, $id_home_service);

        $this->setError("Action effectuée !", "Vous vous êtes bien inscrits sur la prestation", SUCCESS_ALERT);

        $this->redirect($defaultFallBack);
    }
}