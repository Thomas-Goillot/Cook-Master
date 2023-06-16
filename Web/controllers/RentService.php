<?php

namespace Controllers;

use App\Mail;
use App\Controller;

class RentService extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "rentService/index"; 
   
    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }
        if($this->isGestionnaire($this->getUserId()) != true && $this->isAdmin($this->getUserId()) != true){
            $this->redirect('../home');
            exit();
        }

        if($this->isAdmin($this->getUserId()) === true){
            $this->setError("Attention", "Vous êtes un administrateur, merci de ne pas modifier les informations sur cette page", WARNING_ALERT);
        }
    }

    /**
     * Display the view for the rent service
     * @return void
     */
    public function index(): void
    {

        $this->loadModel("Rent");

        $allRent = $this->_model->getAllWithUserInfo();


        $page_name = array("Liste des locations en cours" => $this->default_path);

        $this->render($this->default_path, compact('page_name', 'allRent'), DASHBOARD);
    }

    /**
     * Display the details page
     * @return void
     */
    public function rentDetail(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $idRentCart = (int) $params[0];

        $this->loadModel("Rent");

        $rentCart = $this->_model->getCart($idRentCart);

        $equipment = $this->_model->getAllProductInCart($idRentCart);

        if (count($rentCart) === 0) {
            $this->redirect('../home');
            exit();
        }

        $page_name = array("Liste des locations en cours" => $this->default_path, "Détail de la location" => "rentService/rentDetail/$idRentCart");

        $this->render("rentService/detail", compact('page_name', 'rentCart', 'equipment'), DASHBOARD);

    }
    
    /**
     * Update the status of the rent cart
     * @return void
     */
    public function clientUpdate(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $idRentCart = (int) $params[0];

        $this->loadModel("Rent");

        $rentCart = $this->_model->getCart($idRentCart);

        if (count($rentCart) === 0) {
            $this->redirect('../home');
            exit();
        }

        if($rentCart['status'] < TO_COLLECT){
            $this->setError("Erreur", "Le statut de la commande n\'est pas correct", ERROR_ALERT);
            $this->redirect('../../rentService/rentDetail/' . $idRentCart);
        }

        if($rentCart['status'] === TO_COLLECT){
            $this->_model->updateCartStatusById($idRentCart, COLLECTED);
            $this->setError("Succès", "Le statut de la commande a bien été modifié", SUCCESS_ALERT);
            $this->redirect('../../rentService/rentDetail/' . $idRentCart);
        }

        if($rentCart['status'] === COLLECTED){
            $this->_model->updateCartStatusById($idRentCart, RETURNED);
            $this->setError("Succès", "Le statut de la commande a bien été modifié", SUCCESS_ALERT);
            $this->redirect('../../rentService/rentDetail/' . $idRentCart);
        }

        $this->setError("Erreur", "Aucun statut n\'a été modifié", ERROR_ALERT);
        $this->redirect('../../rentService/rentDetail/' . $idRentCart);
    }

}