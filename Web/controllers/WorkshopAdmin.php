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

        $this->setJsFile(array('location.js','addressSelect.js'));
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
            $defaultErrorPath = "../../WorkshopAdmin/index";
            $defaultValidePath = "../WorkshopAdmin/listWorkshop";
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
            $price = htmlspecialchars($_POST['price']);
            $nb_place = (int)$_POST['nb_place'];
            $nb_stock = $_POST['nb_stock'];
            $id_equipments = array_map('intval', $_POST['id_equipment']);

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


            

            //all condition
            if (strlen($_POST['name']) > MAX_NAME) {
                $this->setError('Nom du produit trop long', "Le nom du produit ne peut pas excéder 50 caractères.", ERROR_ALERT);
                $this->redirect($defaultErrorPath);
            }
            if (strlen($_POST['description']) > MAX_DESCRIPTION) {
                $this->setError('Description trop longue', "La description ne peut pas excéder 500 caractères.", ERROR_ALERT);
                $this->redirect($defaultErrorPath);
            }
            if($_POST['price'] < MIN_PRICE){
                $this->setError('Prix négatif', "Le prix ne peut pas être inférieur à 0.", ERROR_ALERT);
                $this->redirect($defaultErrorPath);
            }
            // if($_POST['location'] == NULL){
            //     $this->setError('Aucun lieu sélectionnée', "Veuillez sélectionner un lieu.", ERROR_ALERT);
            //     $this->redirect($defaultErrorPath);
            // }


            // if (empty(array_filter($_POST['location']))) {
            //     $this->setError('Aucun lieu sélectionné', 'Veuillez sélectionner un lieu.', ERROR_ALERT);
            //     $this->redirect($defaultErrorPath);
            // }

            
            $this->loadModel('Workshop');
            $id_workshop = $this->_model->addWorkshop($description, $name,  $image,$price, $date['start'],$date['end']   ,$nb_place, $location);

            for($i = 0; $i < count($id_equipments); $i++){
               if($nb_stock[$i] > 0){
                    for($j = 0; $j < $nb_stock[$i]; $j++){
                        $this->_model->addWorkshopProduct($id_equipments[$i],$id_workshop);
                    }
               }
            }
            
            
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




        $allWorkshop = $this->_model->getAllWorkshop();

        foreach($allWorkshop as $key => $value){
            $allWorkshop[$key]['address'] = $this->_model->getWorkshopLocation($value['id_location']);
        }

        $page_name = array("Admin" => $this->default_path, "Ateliers" => "listWorkshop");

        $this->render('admin/listWorkshop', compact('page_name', 'allWorkshop'), DASHBOARD);
    }




    /**
     * Display the edit workshop page
     * @return void
     */
    public function editWorkshopDisplay(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_workshop = (int) $params[0];

        

        

        $this->loadModel("Products");
        $allProduct = $this->_model->getAllProducts();

        $this->loadModel('workshop');

        $allWorkshop = $this->_model->getWorkshopById($id_workshop);
        $allIdEquipmentWorkshop = $this->_model->getAllUseEquipmentWorkshopById($id_workshop);

        $stockEquipment = array();

        foreach ($allIdEquipmentWorkshop as $row) {
            $idEquipment = $row['id_equipment'];
            
            if (isset($stockEquipment[$idEquipment])) {
                $stockEquipment[$idEquipment]++;
            } else {
                $stockEquipment[$idEquipment] = 1;
            }
        }

        foreach ($allProduct as $row) {
            $idEquipment = $row['id_equipment'];
            if (!isset($stockEquipment[$idEquipment])) {
                $stockEquipment[$idEquipment] = 0;
            }
        }
        

        $this->loadModel('location');
        $locations = $this->_model->getAllLocationWithOpeningHours();

        
        



        $this->setJsFile(array('location.js','addressSelect.js'));
        $this->setCssFile(array('css/location/location.css'));




        $page_name = array("Admin" => $this->default_path, "Ateliers" => "workshop", "Modification d'atelier" => "admin/workshop/editWorkshopDisplay");
        $this->render('admin/workshop/editWorkshopDisplay', compact('page_name','id_workshop','allProduct','locations','allWorkshop','stockEquipment'), DASHBOARD);
    }

    /**
     * edit workshop
     * @return void
     */
    public function editWorkshop(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_workshop = (int) $params[0];

        if (!isset($_POST['submit'])) {
            $defaultErrorPath = "../../WorkshopAdmin/editWorkshopDisplay/".$id_workshop."";
            $defaultValidePath = "../../WorkshopAdmin/listWorkshop";
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


            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            $image = $filename;
            $price = htmlspecialchars($_POST['price']);
            $nb_place = (int)$_POST['nb_place'];
            $nb_stock = $_POST['nb_stock'];
            $id_equipments = array_map('intval', $_POST['id_equipment']);

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


            

            //all condition
            if (strlen($_POST['name']) > MAX_NAME) {
                $this->setError('Nom du produit trop long', "Le nom du produit ne peut pas excéder 50 caractères.", ERROR_ALERT);
                $this->redirect($defaultErrorPath);
            }
            if (strlen($_POST['description']) > MAX_DESCRIPTION) {
                $this->setError('Description trop longue', "La description ne peut pas excéder 500 caractères.", ERROR_ALERT);
                $this->redirect($defaultErrorPath);
            }
            if($_POST['price'] < MIN_PRICE){
                $this->setError('Prix négatif', "Le prix ne peut pas être inférieur à 0.", ERROR_ALERT);
                $this->redirect($defaultErrorPath);
            }



            
                
        
            
            $this->loadModel('Workshop');
            
            $this->_model->deleteUseEquipmentWorkshop($id_workshop);
            $this->_model->deleteWorkshop($id_workshop);
            $id_workshop = $this->_model->addWorkshop($description, $name,  $image,$price, $date['start'],$date['end'],$nb_place, $location);

            for($i = 0; $i < count($id_equipments); $i++){
               if($nb_stock[$i] > 0){
                    for($j = 0; $j < $nb_stock[$i]; $j++){
                        $this->_model->addWorkshopProduct($id_equipments[$i],$id_workshop);
                    }
               }
            }
            
            
        }

        $this->setError("Atelier modifié", "L'atelier a été modifié avec succès", SUCCESS_ALERT);
        $this->redirect($defaultValidePath);
    }


    /**
     * delete workshop
     * @return void
     */
    public function deleteWorkshop(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_workshop = (int) $params[0];

        $this->loadModel('Workshop');
        $this->_model->deleteUseEquipmentWorkshop($id_workshop);
        $this->_model->deleteWorkshop($id_workshop);

        $this->setError("Atelier supprimé", "L'atelier a été supprimé avec succès", SUCCESS_ALERT);
        $this->redirect('../../WorkshopAdmin/listWorkshop');
    }
}
