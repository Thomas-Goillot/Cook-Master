<?php

namespace Controllers;

use App\Controller;

class rentalEquipment extends Controller
{
   
    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

    }
    /**
     * Display the rentalEquipment page
     * @return void
     */
    public function index(): void
    {
        $this->loadModel("Products");


        $allProduct = $this->_model->getAllProducts();
            
        
        $page_name = array("Louer" => "rentalEquipment");

        

        $this->render('rentalEquipment/index', compact('page_name','allProduct'), DASHBOARD);
    }


    
   
   
}
