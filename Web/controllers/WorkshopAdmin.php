<?php

namespace Controllers;

use App\Controller;
use App\StripePayment;
class WorkshopAdmin extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "workshop/index";

    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

        if ($this->isAdmin($this->getUserId()) === false) {
            $this->redirect('../home');
            exit();
        }
    }

    /**
     * Display the add workshop page
     * @return void
     */
    public function index(): void
    {

        $this->loadModel("Products");
        $allProduct = $this->_model->getAllProducts();

        $this->loadModel('location');
        $locations = $this->_model->getAllLocationWithOpeningHours();

        $this->loadModel('Workshop');

        $this->setJsFile(array('location.js'));
        $this->setCssFile(array('css/location/location.css'));

        $page_name = array("Admin" => $this->default_path, "Ateliers" => "workshop", "Création d'atelier" => "admin/workshop");
        $this->render('admin/workshop', compact('page_name','locations','allProduct'), DASHBOARD);
    }


    /**
     * display the pay page for workshops
     * @return void
     */
    public function pay(): void{
       


        $this->loadModel("User");

        $idUser = $this->getUserId();

        $user = $this->_model->getUserInfo($idUser);

        $userEmail = $user['email'];





        $this->loadModel("Workshop");

        $params = $_GET['params'];


        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_workshop = $params[0];
        $available = $_POST['place'];

        

        $workshop = $this->_model->getWorkshopById($id_workshop);

        $eventData = array(array(
            "name"=> $workshop['name'],
            "price_purchase"=> $workshop['price'],
            "quantity"=> $available
        ));

        $payment = new StripePayment(STRIPE_API_KEY);

        $payment->startPayment($eventData,$userEmail,$this->activeSecurity("WorkshopAdmin/paySuccess",array("id_workshop"=>$id_workshop,"available"=>$available))['url']);

        $page_name = array("Liste des Ateliers" => "AtelierPresentation");

        $this->render('WorkshopAdmin/pay', compact('page_name',), DASHBOARD);

    }

    /**
     * addWorkshop
     * @return void
     */
    public function addWorkhop(): void

    {
        if (!isset($_POST['submit'])) {
            
            $defaultErrorPath = "../admin/addWorkshop";
            $defaultValidePath = "../admin/listWorkshop";
            
            $acceptable = array('image/jpeg', 'image/png');
            $image = $_FILES['image']['type'];

            if (!in_array($image, $acceptable)) {
                $this->setError('Type de fichier non autorisée', "Les type de fichier autorisé sont :  .png et .jpeg", ERROR_ALERT);
                $this->redirect($defaultErrorPath);
            }

            $maxSize = 5 * 1024 * 1024; //5 Mo
            if ($_FILES['image']['size'] > $maxSize) {
                $this->setError('Fichier trop lourd', "la taille du fichier ne doit pas dépasser 5 Mo", ERROR_ALERT);
                $this->redirect($defaultErrorPath);
            }

            //Si le dossier uploads n'existe pas, le créer
            $path = 'assets/images/Workshop';
            if (!file_exists('assets/images/Workshop/')) {
                mkdir('assets/images/Workshop/');
            }

            $filename = $_FILES['image']['name'];

            $array = explode('.', $filename);
            $extension = end($array);

            $filename = 'image-' . time() . '.' . $extension;

            $destination = $path . '/' . $filename;

            move_uploaded_file($_FILES['image']['tmp_name'], $destination);



            $name = $_POST['name'];
            $description = $_POST['description'];
            $image = $filename;
            $price = $_POST['price'];
            $available = $_POST['available'];
            $date = $_POST['WorkshopDate'];


            if (strlen($_POST['name']) > MAX_NAME) {
                $this->setError('Nom du produit trop long', "Le nom du produit ne peut pas excéder 50 caractères.", ERROR_ALERT);
                $this->redirect($defaultErrorPath);
            }
            if (strlen($_POST['description']) > MAX_DESCRIPTION) {
                $this->setError('Description trop longue', "La description ne peut pas excéder 500 caractères.", ERROR_ALERT);
                $this->redirect($defaultErrorPath);
            }




            $this->_model->addWorkshop($name, $description, $image, $price, $available, $date);
        }


        // $this->setError("Atelier créer !", "L'atelier a été créer avec succès", SUCCESS_ALERT);
        // $this->redirect($defaultValidePath);
    }






    /**
     * Display the list workshop page
     * @return void
     */
    public function listWorkshop(): void
    {

        $this->loadModel('workshop');

        // $allWorkshop = $this->_model->getAllWorkshop();

        $page_name = array("Admin" => $this->default_path, "Ateliers" => "listWorkshop");

        $this->render('admin/listWorkshop', compact('page_name'), DASHBOARD);
    }


      /**
     * edit product
     * @return void
     */
    public function editWorkshop(): void
    {
        $this->loadModel("Products");



        if (!isset($_POST['submit'])) {
            $acceptable = array('image/jpeg', 'image/png');
            $image = $_FILES['image']['type'];

            if (!in_array($image, $acceptable)) {
                $this->setError('Type de fichier non autorisée', "Les type de fichier autorisé sont :  .png et .jpeg", ERROR_ALERT);
                $this->redirect('../admin/products');
            }

            $maxSize = 5 * 1024 * 1024; //5 Mo
            if ($_FILES['image']['size'] > $maxSize) {
                $this->setError('Fichier trop lourd', "la taille du fichier ne doit pas dépasser 5 Mo", ERROR_ALERT);
                $this->redirect('../admin/products');
            }

            //Si le dossier uploads n'existe pas, le créer
            $path = 'assets/images/productShop';
            if (!file_exists('assets/images/productShop/')) {
                mkdir('assets/images/productShop/');
            }

            $filename = $_FILES['image']['name'];

            $array = explode('.', $filename);
            $extension = end($array);

            $filename = 'image-' . time() . '.' . $extension;

            $destination = $path . '/' . $filename;

            move_uploaded_file($_FILES['image']['tmp_name'], $destination);


            $params = $_GET['params'];

            if (count($params) === 0 || is_numeric($params[0]) === false) {
                $this->redirect('../home');
                exit();
            }

            $id_workshop = (int) $params[0];

            $name = $_POST['name'];
            $description = $_POST['description'];
            $image = $filename;
            $price = $_POST['price'];
            $available = $_POST['available'];
            $date = $_POST['WorkshopDate'];


            // if (isset($name) || isset($description) || isset($image) || isset($disponibilityStock)) {
            //     $this->setError('Champs non valide', "Veuillez remplir tout les champs.", ERROR_ALERT);
            //     $this->redirect('../admin/products');
            // }

            $defaultFallBack = '../editProductDisplay/' . $id_workshop;

            if (strlen($_POST['name']) > MAX_NAME) {
                $this->setError('Nom du produit trop long', "Le nom du produit ne peut pas excéder 50 caractères.", ERROR_ALERT);
                $this->redirect($defaultFallBack);
            }
            if (strlen($_POST['description']) > MAX_DESCRIPTION) {
                $this->setError('Description trop longue', "La description ne peut pas excéder 500 caractères.", ERROR_ALERT);
                $this->redirect($defaultFallBack);
            }



            $this->_model->editWorshop($name, $description, $image, $price, $available, $date, $id_workshop);
        }
        $this->setError("Produit mis a jour !", "Toutes les modifications du produit on été mis a jour avec succès !", SUCCESS_ALERT);
        $this->redirect("../products");
    }

}
