<?php

namespace Controllers;

use App\Controller;
use App\StripePayment;

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


        $allProduct = $this->_model->getAllProductsAvailableAndRentable();
            
        
        $page_name = array("Louer" => "rentalEquipment");

        

        $this->render('rentalEquipment/index', compact('page_name','allProduct'), DASHBOARD);
    }


    /**
     * Add a product to the cart verif method
     * @return void
     */
    public function addProductToCart(): void
    {
        $defaultFallBack = "../rentalEquipment";

        if (!isset($_POST)) {
            $this->setError("Erreur", "Une erreur est survenue", ERROR_ALERT);
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

        if (!is_numeric($numberOfProduct)) {
            $this->setError("Erreur", "Le nombre de produit doit être un nombre", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        if (!is_numeric($idProduct)) {
            $this->setError("Erreur", "L\'id du produit doit être un nombre", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        if (!isset($productExist['id_equipment'])) {
            $this->setError("Erreur", "Le produit n'existe pas", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        $this->loadModel("rent");

        $idUser = $this->getUserId();

        $userCartId = $this->_model->getUserCartId($idUser);

        if ($userCartId === false) {
            $this->_model->createCart($idUser);
            $userCartId = $this->_model->getUserCartId($idUser);
        }

        if (!$this->_model->addProductToCart($userCartId, $idProduct, $numberOfProduct)) {
            $this->setError("Erreur", "Une erreur est survenue lors de l\'ajout du produit au panier", ERROR_ALERT);
            $this->redirect('../rentalEquipment');
        }

        $this->setError("Succès", "Le produit a bien été ajouté au panier", SUCCESS_ALERT);
        $this->redirect('../rentalEquipment');
    }

    /**
     * Display the invoiceRecap page
     * @return void
     */
    public function cart(): void
    {
        $this->loadModel("rent");

        $idUser = $this->getUserId();

        $orderId  = $this->_model->getUserCartId($idUser);

        if ($orderId  === false) {
            $this->setError("Erreur", "Vous n\'avez pas de panier", ERROR_ALERT);
            $this->redirect('../rentalEquipment');
        }

        $cart = $this->_model->getCart( $orderId);

        $allProduct = $this->_model->getAllProductInCart( $orderId);

        $sum = 0;
        foreach ($allProduct as $product) {
            $sum += $product['price_rental'] * $product['quantity'];
        }

        $tva = round($sum * TVA, 2);
        $priceWithoutTva = round($sum - $tva, 2);

        $_SESSION['price_rental'] = $sum;

        $pathToPayment = "rentalEquipment/addressselect";
        $buttonName = "Continuer";

        $page_name = array("Panier de location" => "../rentalEquipment/cart");

        $this->render('rentalEquipment/invoiceRecap', compact('page_name', 'orderId', 'allProduct', 'sum', 'tva', 'priceWithoutTva', 'pathToPayment', 'buttonName'),DASHBOARD);
    }

    /**
     * Display the livraison page choice
     * @return void
     */
    public function addressselect(): void
    {
        $this->loadModel("User");

        $idUser = $this->getUserId();

        $user = $this->_model->getUserInfo($idUser);

        $this->loadModel("Rent");
        $userCartId = $this->_model->getUserCartId($idUser);

        if ($userCartId === false) {
            $this->setError("Mince... Votre panier est vide !", "Il est temps d\'aller faire du shopping", INFO_ALERT);
            $this->redirect('../rentalEquipment');
        }

        $this->loadModel('Location');

        $allRelayPoint = $this->_model->getAllLocationWithOpeningHours();

        $this->setJsFile(array('location.js','addressSelectRental.js'));
        $this->setCssFile(array('css/location/location.css'));

        $page_name = array("Panier de location" => "../rentalEquipment/cart", "Adresse de collecte" => "../rentalEquipment/addressselect");

        $this->render('rentalEquipment/addressSelect', compact('page_name', 'allRelayPoint', 'user'), DASHBOARD);
    }

    /**
     * Save the relay point selected by the user
     * @return void
     */
    public function relayPointSave(): void
    {
        $this->loadModel("Rent");

        $idUser = $this->getUserId();

        $userCartId = $this->_model->getUserCartId($idUser);

        $defaultFallBack = "../rentalEquipment/addressselect";

        if ($userCartId === false) {
            $this->setError("Mince... Votre panier est vide !", "Il est temps d\'aller faire du shopping", INFO_ALERT);
            $this->redirect('../rentalEquipment');
        }

        if (!isset($_POST['idRelayPoint']) && empty($_POST['idRelayPoint'])) {
            $this->setError("Erreur", "Une erreur est survenue lors de la sélection du point relais", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        $idRelayPoint = htmlspecialchars($_POST['idRelayPoint']);

        $this->loadModel('Location');

        $relayPointExist = $this->_model->getLocationInfoById($idRelayPoint);

        if (!isset($relayPointExist['id_location'])) {
            $this->setError("Erreur", "Le point relais n\'existe pas", ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        $this->loadModel("Rent");

        $this->_model->updateCartRelayPoint($userCartId, $idRelayPoint);

        $this->setError("Succès", "Le point relais a bien été enregistré", SUCCESS_ALERT);
        $this->redirect('../rentalEquipment/pay');
    }

    /**
     * Display the payment page
     * @return void
     */
    public function pay(): void
    {
        $idUser = $this->getUserId();

        $this->loadModel("User");

        $user = $this->_model->getUserInfo($idUser);

        $userEmail = $user['email'];

        $this->loadModel("Rent");

        $userCartId = $this->_model->getUserCartId($idUser);

        if ($userCartId === false) {
            $this->setError("Mince... Votre panier est vide !", "Il est temps d\'aller faire du shopping", INFO_ALERT);
            $this->redirect('../rentalEquipment');
        }

        $data = array(array(
            "name" => "Location de matériel",
            "price_purchase" => $_SESSION['price_rental'],
            "id" => "online",
            "quantity" => 1,
            "description" => "Location de matériel professionnel pour 24h",
            "allow_purchase" => 0
        ));

        $payment = new StripePayment(STRIPE_API_KEY);

        $payment->startPayment($data, $userEmail);
    }

    /**
     * Display the success page
     * @return void
     */
    public function success(): void
    {
        $this->loadModel("Rent");

        $idUser = $this->getUserId();

        $userCartId = $this->_model->getUserCartId($idUser);
        
        if ($userCartId === false) {
            $this->setError("Mince... Votre panier est vide !", "Il est temps d\'aller faire du shopping", INFO_ALERT);
            $this->redirect('../rentalEquipment');
        }

        $this->_model->updateCartStatus($userCartId, TO_COLLECT);

        $_SESSION['price_rental'] = NULL;

        $this->setError("Succès", "Votre commande a bien été enregistré", SUCCESS_ALERT);
        $this->redirect('../rent');
    }

    /**
     * Display the cancel page
     * @return void
     */
    public function cancel(): void
    {
        $this->setError("Erreur", "Une erreur est survenue lors du payment", ERROR_ALERT);
        $this->redirect('../rentalEquipment');
    }


}
