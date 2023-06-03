<?php

namespace Controllers;

use App\Controller;
use App\StripePayment;

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
        
        $nbProduct = $this->getNbProductInCart($userCartId);

        $sum = $this->getSumCart($userCartId);

        $page_name = array("Boutique" => "shop", "Panier" => "shop/cart");

        $this->setCssFile(array('css/shop/cart.css'));
        $this->setJsFile(array('cart.js'));

        $this->render('shop/cartRecap', compact('page_name', 'allProduct','nbProduct','sum'), DASHBOARD);
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

    /**
     * Display the livraison page choice
     * @return void
     */
    public function addressselect() : void
    {
        $this->loadModel("User");
        
        $idUser = $this->getUserId();

        $user = $this->_model->getUserInfo($idUser);
        
        $this->loadModel("Shop");
        $userCartId = $this->_model->getUserCartId($idUser);

        if($userCartId === false){
            $this->setError("Mince... Votre panier est vide !","Il est temps d\'aller faire du shopping", INFO_ALERT);
            $this->redirect('../shop');
        }

        $userShippingAddress = $this->_model->getUserShippingAddress($idUser);
        
        
        $this->loadModel('Location');

        $allRelayPoint = $this->_model->getAll();

        $this->setJsFile(array('location.js','addressSelect.js'));
        $this->setCssFile(array('css/location/location.css'));

        $page_name = array("Boutique" => "shop", "Panier" => "shop/cart", "Type de livraison" => "shop/addressselect");

        $this->render('shop/addressSelect', compact('page_name', 'allRelayPoint', 'userShippingAddress', 'user'), DASHBOARD);
    }

    /**
     * Save the relay point selected by the user
     * @return void
     */
    public function relayPointSave(): void{
        $this->loadModel("Shop");

        $idUser = $this->getUserId();

        $userCartId = $this->_model->getUserCartId($idUser);

        $defaultFallBack = "../shop/addressselect";

        if($userCartId === false){
            $this->setError("Mince... Votre panier est vide !","Il est temps d\'aller faire du shopping", INFO_ALERT);
            $this->redirect('../shop');
        }

        if(!isset($_POST['idRelayPoint']) && empty($_POST['idRelayPoint'])){
            $this->setError("Erreur","Une erreur est survenue lors de la sélection du point relais", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        //check if the relay point exist and if it's a int
        $idRelayPoint = htmlspecialchars($_POST['idRelayPoint']);

        $this->loadModel('Location');

        $relayPointExist = $this->_model->getLocationInfoById($idRelayPoint);

        if(!isset($relayPointExist['id_location'])){
            $this->setError("Erreur","Le point relais n\'existe pas", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        $this->loadModel("Shop");

        $this->_model->updateCartRelayPoint($userCartId,$idRelayPoint);

        $this->setError("Succès","Le point relais a bien été enregistré", SUCCESS_ALERT);
        $this->redirect('../shop/invoiceRecap');
    }

    /**
     * Save the address set by the user 
     * @return void
     */
    public function addressSave(): void{
        $this->loadModel("Shop");

        $idUser = $this->getUserId();

        $userCartId = $this->_model->getUserCartId($idUser);

        if($userCartId === false){
            $this->setError("Mince... Votre panier est vide !","Il est temps d\'aller faire du shopping", INFO_ALERT);
            $this->redirect('../shop');
        }

        $defaultFallBack = "../shop/addressselect";

        if(!isset($_POST['name']) && empty($_POST['name']) && !isset($_POST['address']) && empty($_POST['address']) && !isset($_POST['city']) && empty($_POST['city']) && !isset($_POST['zipCode']) && empty($_POST['zipCode']) && !isset($_POST['country']) && empty($_POST['country']) && !isset($_POST['userShippingAddress']) || empty($_POST['userShippingAddress']) || $_POST['userShippingAddress'] == 0 || $_POST['userShippingAddress'] == -1){
            $this->setError("Erreur","Une erreur est survenue lors de la sélection de l\'adresse", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        $name = htmlspecialchars($_POST['name']);
        $address = htmlspecialchars($_POST['address']);
        $city = htmlspecialchars($_POST['city']);
        $zipCode = htmlspecialchars($_POST['zipCode']);
        $country = htmlspecialchars($_POST['country']);

        if(strlen($name) > SHIPPING_ADDRESS_NAME_MAX_LENGTH){
            $this->setError("Erreur","Le nom de l\'adresse ne doit pas dépasser ". SHIPPING_ADDRESS_NAME_MAX_LENGTH." caractères", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        if(strlen($address) > SHIPPING_ADDRESS_ADDRESS_MAX_LENGTH){
            $this->setError("Erreur","L\'adresse ne doit pas dépasser ". SHIPPING_ADDRESS_ADDRESS_MAX_LENGTH." caractères", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        if(strlen($city) > SHIPPING_ADDRESS_CITY_MAX_LENGTH){
            $this->setError("Erreur","La ville ne doit pas dépasser ". SHIPPING_ADDRESS_CITY_MAX_LENGTH." caractères", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        if(strlen($country) > SHIPPING_ADDRESS_COUNTRY_MAX_LENGTH){
            $this->setError("Erreur","Le pays ne doit pas dépasser ". SHIPPING_ADDRESS_COUNTRY_MAX_LENGTH." caractères", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }
        
        $this->loadModel("Shop");

        if(isset($_POST['userShippingAddress']) && $_POST['userShippingAddress'] == -1 || !isset($_POST['userShippingAddress']) ){
            $this->_model->addCartAddress($userCartId, $idUser,$name,$address,$city,(int)$zipCode,$country);
        }
        else{
            $userShippingAddress = htmlspecialchars($_POST['userShippingAddress']);
            $this->_model->updateCartAddress($userCartId, $idUser, $userShippingAddress, $name, $address, $city, $zipCode, $country);
        }

        $this->setError("Succès","L\'adresse a bien été enregistré", SUCCESS_ALERT);
        $this->redirect('../shop/invoiceRecap');
    }


    /**
     * Display the invoice recap page
     */
    public function invoiceRecap() : void
    {
        $idUser = $this->getUserId();

        $this->loadModel("User");

        $user = $this->_model->getUserInfo($idUser);

        if(empty($user['address']) || empty($user['city']) || empty($user['zip_code']) || empty($user['country'])){
            $this->setError("Erreur","Veuillez renseigner votre adresse dans votre profil", ERROR_ALERT);
            $this->redirect('../users/editProfil');
        }


        $this->loadModel("Shop");

        $orderId = $this->_model->getUserCartId($idUser);

        if($orderId === false){
            $this->setError("Mince... Votre panier est vide !","Il est temps d\'aller faire du shopping", INFO_ALERT);
            $this->redirect('../shop');
        }

        $allProduct = $this->_model->getAllProductsOfCart($orderId);

        $sum = $this->getSumCart($orderId);

        $shippingType = $this->_model->getShippingType($orderId);

        if($shippingType === false){
            $this->setError("Erreur","Une erreur est survenue lors de la récupération du type de livraison", ERROR_ALERT);
            $this->redirect('../shop');
        }


        if($this->isSubscription(FREE_SUBSCRIPTION) || $this->isSubscription(STARTER_SUBSCRIPTION)){
            if ($shippingType['type'] == RELAY_POINT) {
                if($this->isSubscription(STARTER_SUBSCRIPTION)){
                    #livraison gratuite
                    array_push($allProduct, array('name' => 'Livraison gratuite', 'description' => 'Livraison gratuite grâce à votre abonnement', 'price_purchase' => 0, 'quantity' => 1, 'allow_purchase' => 0));
                }
                else{
                    array_push($allProduct, array('name' => 'Point relais', 'description' => 'Livraison en point relais', 'price_purchase' => RELAY_POINT_PRICE, 'quantity' => 1, 'allow_purchase' => 0));
                    $sum += RELAY_POINT_PRICE;
                }
            } else {
                array_push($allProduct, array('name' => 'Livraison à domicile', 'description' => 'Livraison à domicile', 'price_purchase' => HOME_DELIVERY_PRICE, 'quantity' => 1, 'allow_purchase' => 0));
                $sum += HOME_DELIVERY_PRICE;
            }
        }
        else{
            array_push($allProduct, array('name' => 'Livraison gratuite', 'description' => 'Livraison gratuite grâce à votre abonnement', 'price_purchase' => 0, 'quantity' => 1, 'allow_purchase' => 0));
        }


        if ($this->isSubscription(MASTER_SUBSCRIPTION)) {

            $sum = $sum * 0.95;
            $diff = $sum * 0.05;

            $sum = round($sum, 2);
            $diff = round($diff, 2);

            array_push($allProduct, array('name' => 'Réduction de 5%', 'description' => 'Réduction de 5% sur votre commande grâce à votre abonnement', 'price_purchase' => -$diff, 'quantity' => 1, 'allow_purchase' => 0));
        }


        //calculate the tva and the price without tva
        $tva = round($sum * TVA, 2);
        $priceWithoutTva = round($sum - $tva, 2);

        $_SESSION['price_shopping'] = $sum;

        $pathToPayment = "shop/pay";

        $page_name = array("Boutique" => "shop", "Panier" => "shop/cart", "Type de livraison" => "shop/addressselect", "Récapitulatif" => "shop/invoicerecap");

        $this->render('shop/invoiceRecap', compact('page_name', 'allProduct', 'sum', 'user', 'orderId', 'tva', 'priceWithoutTva', 'pathToPayment'), DASHBOARD);
    }

    /**
     * Display the payment page
     * @return void
     */
    public function pay() : void
    {
        $idUser = $this->getUserId();

        $this->loadModel("User");

        $user = $this->_model->getUserInfo($idUser);

        $userEmail = $user['email'];

        $this->loadModel("Shop");

        $userCartId = $this->_model->getUserCartId($idUser);

        if($userCartId === false){
            $this->setError("Mince... Votre panier est vide !","Il est temps d\'aller faire du shopping", INFO_ALERT);
            $this->redirect('../shop');
        }

        $data = array(array(
            "name" => "Achat en ligne",
            "price_purchase" => $_SESSION['price_shopping'],
            "id" => "online",
            "quantity" => 1,
            "description" => "Achat en ligne",
            "allow_purchase" => 0
        ));



        $payment = new StripePayment(STRIPE_API_KEY);

        $payment->startPayment($data, $userEmail);

        $page_name = array("Boutique" => "shop", "Panier" => "shop/cart", "Type de livraison" => "shop/addressselect", "Récapitulatif" => "shop/invoicerecap", "Paiement" => "shop/pay");

        $this->render('shop/pay', compact('page_name', 'allProduct', 'sum', 'user', 'userCartId', 'tva', 'priceWithoutTva'), DASHBOARD);
    }

    /**
     * Display the success page
     * @return void
     */
    public function success() : void
    {
        $this->loadModel("Shop");

        $idUser = $this->getUserId();

        $userCartId = $this->_model->getUserCartId($idUser);

        if($userCartId === false){
            $this->setError("Mince... Votre panier est vide !","Il est temps d\'aller faire du shopping", INFO_ALERT);
            $this->redirect('../shop');
        }

        $this->_model->updateCartStatus($userCartId, CART_VALIDATE);

        $this->setError("Succès","Votre commande a bien été enregistré", SUCCESS_ALERT);
        $this->redirect('../shop');
    }
        
    /**
     * Display the cancel page
     * @return void
     */
    public function cancel() : void
    {
        $this->setError("Erreur", "Une erreur est survenue lors du payment", ERROR_ALERT);
        $this->redirect('../shop');
    }
        

    /**
     * NOT A PAGE
     * Get the number of product in the cart
     * @return int
     */
    private function getNbProductInCart(int $idCart): int
    {
        $this->loadModel("Shop");

        $allproduct = $this->_model->getAllProductsOfCart($idCart);

        $nbProduct = 0;
        foreach ($allproduct as $product) {
            $nbProduct += $product['quantity'];
        }

        return $nbProduct;
    }

    /**
     * NOT A PAGE
     * Get the sum of the cart
     * @return int
     */
    private function getSumCart(int $idCart): int
    {
        $this->loadModel("Shop");

        $allproduct = $this->_model->getAllProductsOfCart($idCart);

        $sum = 0;
        foreach ($allproduct as $product) {
            $sum += $product['price_purchase'] * $product['quantity'];
        }

        return $sum;
    }

}
