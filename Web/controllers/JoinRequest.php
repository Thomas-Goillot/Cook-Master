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
   
}
