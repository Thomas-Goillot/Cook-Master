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
   
}
