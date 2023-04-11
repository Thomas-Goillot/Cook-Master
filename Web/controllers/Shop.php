<?php

namespace Controllers;

use App\Controller;

class Shop extends Controller
{
   
    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

    }
    /**
     * Display the Shop page
     * @return void
     */
    public function index(): void
    {
        $this->loadModel("Products");


        $allProduct = $this->_model->getAllProducts();
            
        
        $page_name = array("Boutique" => "shop");

        

        $this->render('shop/index', compact('page_name','allProduct'), DASHBOARD);
    }


    // public function updateStock(): void
    // {
        

    //         $newStock = (int)$_POST['dispnobilityStock'] - $_POST['upStock'];

    //         $idEquipment = 52;


    //         $this->loadModel("Products");

    //         $this->_model->updateStock($newStock,$idEquipment);
        

    //     // $this->redirect('../admin/products');
    // }
   
   
}
