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
     * @return void
     */ 
    public function Supp(): void
    {
        $defaultFallBack = "../index";

        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id = (int) $params[0];
        
        $this->loadModel("joinRequest");

        $supp = $this->_model->Add($id);

        $this->redirect($defaultFallBack);
        exit();

    }
   
}
