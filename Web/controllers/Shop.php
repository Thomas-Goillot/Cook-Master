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

        $defaultFallBack = "../shop";

        if(!isset($_POST)){
            $this->setError("Erreur","Une erreur est survenue", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        if (!isset($_POST['idProduct']) && !isset($_POST['numberOfProduct']) && empty($_POST['idProduct']) && empty($_POST['numberOfProduct'])) {
            $this->setError("Erreur", "Merci de remplir tous les champs", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        $numberOfProduct = htmlspecialchars($_POST['numberOfProduct']);
        $idProduct = htmlspecialchars($_POST['idProduct']);     
        
        $this->loadModel("Products");

        $productExist = $this->_model->getEquipmentById($idProduct);

        if(!is_numeric($numberOfProduct)){
            $this->setError("Erreur","Le nombre de produit doit être un nombre", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        if(!is_numeric($idProduct)){
            $this->setError("Erreur","L'id du produit doit être un nombre", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        if(!isset($productExist['id_equipment'])){
            $this->setError("Erreur","Le produit n'existe pas", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        $this->loadModel("Shop");
        
        $idUser = $this->getUserId();

        $userCartId = $this->_model->getUserCartId($idUser);

        if($userCartId === false){
            $this->_model->createCart($idUser);
            $userCartId = $this->_model->getUserCartId($idUser);
        }

        if(!$this->_model->addProductToCart($userCartId,$idProduct,$numberOfProduct)){
            $this->setError("Erreur","Une erreur est survenue lors de l'ajout du produit au panier", ERROR_ALERT);
            $this->redirect('../shop');
        }

        $this->setError("Succès","Le produit a bien été ajouté au panier", SUCCESS_ALERT);
        $this->redirect('../shop');


       


    }


}
