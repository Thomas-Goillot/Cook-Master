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



    public function verifCart() : void
    {
        $this->loadModel("Shop");

        
        $id_users = $_SESSION['user']['id_users'];

       

        $verifCart = $this->_model->verifCart($id_users);

        

        
        if($verifCart == true){

            $this->setError('Produit ajouté au panier !','Votre produit a bien été ajouter dans votre panier !',SUCCESS_ALERT);
            $this->redirect('../shop');
        }

        
        if($verifCart == false){
             $id_command_status = 1;
             $this->_model->createCart($id_command_status,$id_users);


            $this->setError('Produit ajouté au panier !','Votre produit a bien été ajouter dans votre panier !',SUCCESS_ALERT);
            $this->redirect('../shop');
        }


        

    }


}
