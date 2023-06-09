<?php

namespace Controllers;

use App\Controller;

class Rent extends Controller
{
   
    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

    }
    /**
     * Display the rent page
     * @return void
     */ 
    public function index(): void
    {
        $this->loadModel("Rent");

        $allRent = $this->_model->getAllRent($this->getUserId()); 

        $this->loadModel("User");

        foreach($allRent as $key => $rent){
            $data = $this->_model->getUserInfo($rent['id_users']);
            $allRent[$key]['name'] = $data['name'];
            $allRent[$key]['surname'] = $data['surname'];
        }
        
        $page_name = array("Utilisateur" => "users/profil","Mes locations d'équipement" => "rent");

        $this->render('rent/index', compact('page_name','allRent'), DASHBOARD);
    }
   
}
