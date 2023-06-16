<?php

namespace Controllers;

use App\Controller;

class JoinRequest extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "humanResources/joinRequest"; 
   
    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

        if($this->isRh($this->getUserId()) != true && $this->isAdmin($this->getUserId()) != true){
            $this->redirect('../home');
            exit();
        }


        if ($this->isAdmin($this->getUserId()) === true) {
            $this->setError("Attention", "Vous êtes un administrateur, merci de ne pas modifier les informations sur cette page", WARNING_ALERT);
        }

    }
    
    /**
     * Display the joinRequest page
     * @return void
     */ 
    public function index(): void
    {
        $this->loadModel("joinRequest");

        $getAllRequest = $this->_model->getAllRequest();

        $page_name = array("Candidatures" => $this->default_path);

        $this->render($this->default_path, compact('getAllRequest', 'page_name'), DASHBOARD);
    }

    /**
     * Add someone to providers list
     * @return void
     */ 
    public function Add(): void
    {
        $defaultFallBack = "../index";

        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id = (int) $params[0];
        
        $this->loadModel("joinRequest");

        $add = $this->_model->Add($id);

        $this->redirect($defaultFallBack);
        exit();

    }

    /**
     * Delete someone to providers list
     * @param int $id_users
     * @return void
     */ 
    public function supp($id_users): void
    {
        $defaultFallBack = "../index";

        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect($defaultFallBack);
            exit();
        }

        $id_users = (int) $params[0];
        
        $this->loadModel("joinRequest");

        $supp = $this->_model->supp($id_users);

        $this->setError("Action effectuée !", "Le prestataire a bien été supprimé", SUCCESS_ALERT);

        $this->redirect($defaultFallBack);
    }
   
}
