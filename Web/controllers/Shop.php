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


    /**
     * Add a product to the cart verif method
     * @return void
     */
    public function addProductToCart() : void
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
            $this->setError("Erreur","L\'id du produit doit être un nombre", ERROR_ALERT);
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
            $this->setError("Erreur","Une erreur est survenue lors de l\'ajout du produit au panier", ERROR_ALERT);
            $this->redirect('../shop');
        }

        $this->setError("Succès","Le produit a bien été ajouté au panier", SUCCESS_ALERT);
        $this->redirect('../shop');
    }

    /**
     * Display the cart page
     * @return void
     */
    public function cart() : void
    {
        $this->loadModel("Shop");

        $idUser = $this->getUserId();

        $userCartId = $this->_model->getUserCartId($idUser);

        if($userCartId === false){
            $this->setError("Mince... Votre panier est vide !","Il est temps d\'aller faire du shopping", INFO_ALERT);
            $this->redirect('../shop');
        }

        $allProduct = $this->_model->getAllProductsOfCart($userCartId);
        $nbProduct = count($allProduct);

        $page_name = array("Boutique" => "shop", "Panier" => "shop/cart");

        $this->setCssFile(array('css/shop/cart.css'));
        $this->setJsFile(array('cart.js'));

        $this->render('shop/cartRecap', compact('page_name', 'allProduct','nbProduct'), DASHBOARD);
    }

    /**
     * Delete a product from the cart
     * @return void
     */
    public function deleteProductInCart() : void
    {

        $this->loadModel('Shop');

        $id = $this->getUserId();

        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!empty($_POST['idEquipment'])) {
            $idEquipment = htmlspecialchars($_POST['idEquipment']);
        } else {
            echo json_encode(array(
                'title' => 'Petit malin !',
                'message' => 'Merci de ne pas modifier le code source de la page !',
                'type' => 'warning',
                'redirect' => 'false',
            ));
            exit;
        }

        $userCartId = $this->_model->getUserCartId($id);

        if($userCartId === false){
            echo json_encode(array(
                'title' => 'Erreur !',
                'message' => 'Une erreur est survenue lors de la suppression du produit !',
                'type' => 'error',
                'redirect' => 'false',
            ));
            exit;
        }

        $res = $this->_model->deleteProductInCart($userCartId,$idEquipment);

        $allProduct = $this->_model->getAllProductsOfCart($userCartId);

        $redirect = false;
        if (empty($allProduct)) {
            $this->_model->deleteCart($userCartId);
            $redirect = true;
        }


        if ($res) {
            echo json_encode(array(
                'title' => 'Produit supprimé !',
                'message' => 'Le produit a bien été supprimé de votre panier !',
                'type' => 'success',
                'redirect' => $redirect,
            ));
            exit;
        } else {
            echo json_encode(array(
                'title' => 'Erreur !',
                'message' => 'Une erreur est survenue lors de la suppression du produit !',
                'type' => 'error',
                'redirect' => $redirect,
            ));
            exit;
        }




    }


}
