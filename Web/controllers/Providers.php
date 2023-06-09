<?php

namespace Controllers;

use App\Controller;

class Providers extends Controller
{   
    /**
    * Default path to the view
    * @var string
    */
   private string $default_path = "humanResources/listProviders"; 

   
    public function __construct()
    {
        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

        if ($this->isAdmin($this->getUserId()) === true) {
            $this->setError("Attention", "Vous êtes un administrateur, merci de ne pas modifier les informations sur cette page", WARNING_ALERT);
        }
    }

    /**
     * Display the stats page
     * @return void
     */ 
    public function index(): void
    {
        $this->loadModel("Providers");

        $getAllProvidersValidate = $this->_model->getAllProvidersValidate();
        
        $page_name = array("Liste des prestataires" => "humanResources/listProviders"); 

        $this->render('humanResources/listProviders', compact('page_name', 'getAllProvidersValidate'), DASHBOARD);
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
        
        $this->loadModel("Providers");

        $supp = $this->_model->supp($id_users);

        $this->setError("Action effectuée !", "Le prestataire a bien été supprimé", SUCCESS_ALERT);

        $this->redirect($defaultFallBack);
    }
}
