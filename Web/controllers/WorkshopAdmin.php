<?php

namespace Controllers;

use App\Controller;

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
     * addWorkshop
     * @return void
     */
    public function addWorkshop(): void

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

            //part of name, description, etc..

            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            $image = $filename;
            $image2 = $filename;
            $image3 = $filename;
            $price = htmlspecialchars($_POST['price']);
            $available = htmlspecialchars($_POST['available']);
            //date gestion

            $date = htmlspecialchars($_POST['WorkshopDate']);
            $date = explode('-', $date);
            $date['start'] = $date[0];
            $date['end'] = $date[1];

            $date['start'] = str_replace('/', '-', $date['start']);
            $date['end'] = str_replace('/', '-', $date['end']);

            
            $date['start'] = date('Y-m-d', strtotime($date['start']));
            $date['end'] = date('Y-m-d', strtotime($date['end']));


            //part of location
            $location = htmlspecialchars($_POST['location']);


            if (strlen($_POST['name']) > MAX_NAME) {
                $this->setError('Nom du produit trop long', "Le nom du produit ne peut pas excéder 50 caractères.", ERROR_ALERT);
                $this->redirect($defaultErrorPath);
            }
            if (strlen($_POST['description']) > MAX_DESCRIPTION) {
                $this->setError('Description trop longue', "La description ne peut pas excéder 500 caractères.", ERROR_ALERT);
                $this->redirect($defaultErrorPath);
            }


            
                
        


            dump($_POST);
            dump($_FILES);
            die();
            $this->loadModel('Workshop');
            $this->_model->addWorkshop($description, $name,  $image, $image2, $image3 ,$price, $available, $date['start'],$date['end'],$location);
        }
        $this->setError("Atelier créer !", "L'atelier a été créer avec succès", SUCCESS_ALERT);
        $this->redirect($defaultValidePath);
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
