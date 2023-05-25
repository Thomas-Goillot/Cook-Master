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

        
        
        $page_name = array("Utilisateur" => "users/profil","Mes locations d'équipement" => "rent");

        

        $this->render('rent/index', compact('page_name'), DASHBOARD);
    }


    // public function addRent(): void
    // {
    //         $this->loadModel("Rent");

    //         $id_equipment = ;

    //         $id_users = ;


    //         $this->_model->addRent($id_users,$id_equipment);
        

    //     // $this->redirect('../admin/products');
    // }
   
   
}
