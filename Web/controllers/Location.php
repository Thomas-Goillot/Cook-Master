<?php

namespace Controllers;

use App\Controller;

class Location extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "location/index";

    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

        $this->loadModel('User');

        $id_access = $this->_model->getAll();

        $id_access = (int)$id_access[0]['id_access'];

        if ($this->isAdmin($id_access) === false) {
            $this->redirect('../home');
            exit();
        }
    }

    public function index():void
    {
        $this->loadModel('location');
        $locations = $this->_model->getAllLocationWithOpeningHours();

        $this->setJsFile(array('location.js'));
        $this->setCssFile(array('css/location/location.css'));

        $page_name = array("Admin" => $this->default_path, "Sites" => $this->default_path, "Liste des sites" => $this->default_path);

        $this->render($this->default_path, compact('page_name','locations'), DASHBOARD,'../');
    }

    /**
     * ajax request to get the location view
     * @return void
     */
    public function getlocationWithView():void
    {

        $days = array(MONDAY, TUESDAY, WEDNESDAY, THURSDAY, FRIDAY, SATURDAY, SUNDAY);
        $data = json_decode(file_get_contents('php://input'), true);

        $id_location = $data['idLocation'];

        $this->loadModel('location');

        $location = $this->_model->getLocationInfoById($id_location);

        echo $this->generateFile('views/location/locationCard.php', compact('location', 'days'));
    }



    public function createLocation():void
    {

        $days = array(MONDAY, TUESDAY, WEDNESDAY, THURSDAY, FRIDAY, SATURDAY, SUNDAY);
        $days_fr = array(MONDAY_FR, TUESDAY_FR, WEDNESDAY_FR, THURSDAY_FR, FRIDAY_FR, SATURDAY_FR, SUNDAY_FR);

        $page_name = array("Admin" => $this->default_path, "Sites" => $this->default_path, "Créer un site" => $this->default_path);

        $this->setJsFile(array('location.js'));

        $this->render("location/createLocation", compact('page_name','days','days_fr'), DASHBOARD, '../');
    }

    public function add():void
    {
        if (empty($_POST['location_name']) || empty($_POST['location_address']) || !isset($_POST['location_price_day']) || !isset($_POST['location_price_half_day'])) {
            $this->setError('Erreur', 'Tous les champs doivent être remplis.', ERROR_ALERT);
            $this->redirect('../location/createLocation');
            exit;
        }

        $name = htmlspecialchars($_POST['location_name']);
        $address = htmlspecialchars($_POST['location_address']);
        $is_open = isset($_POST['location_is_open']) ? 1 : 0;
        $available_to_rental = htmlspecialchars($_POST['location_available_to_rental']);
        $price_day = htmlspecialchars($_POST['location_price_day']);
        $price_half_day = htmlspecialchars($_POST['location_price_half_day']);
        $user_id = $this->getUserId();

        if(strlen($name) > LOCATION_NAME) {
            $this->setError('Erreur', 'Le nom ne doit pas dépasser '. LOCATION_NAME.' caractères.', ERROR_ALERT);
            $this->redirect('../location/createLocation');
            exit;
        }

        if(strlen($address) > LOCATION_ADDRESS) {
            $this->setError('Erreur', 'L\'adresse ne doit pas dépasser '. LOCATION_ADDRESS.' caractères.', ERROR_ALERT);
            $this->redirect('../location/createLocation');
            exit;
        }

        if($available_to_rental != 1 && $available_to_rental != 0) {
            $this->setError('Erreur', 'Le champ "Disponible à la location" est mal formaté.', ERROR_ALERT);
            $this->redirect('../location/createLocation');
            exit;
        }

        if(!is_numeric($price_day) || !is_numeric($price_half_day)) {
            $this->setError('Erreur', 'Le prix doit être un nombre.', ERROR_ALERT);
            $this->redirect('../location/createLocation');
            exit;
        }

        if($price_day < 0 || $price_half_day < 0) {
            $this->setError('Erreur', 'Le prix ne peut pas être négatif.', ERROR_ALERT);
            $this->redirect('../location/createLocation');
            exit;
        }

        $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        foreach ($days as $day) {
            $ohm = $_POST['opening_hours_morning_' . $day];
            $chm = $_POST['closing_hours_morning_' . $day];
            $oha = $_POST['opening_hours_afternoon_' . $day];
            $cha = $_POST['closing_hours_afternoon_' . $day];

            if (!empty($ohm) && !empty($chm) && !empty($oha) && !empty($cha)) {
                if (!preg_match('/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', $ohm) || !preg_match('/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', $chm) || !preg_match('/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', $oha) || !preg_match('/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', $cha)) {

                    $this->setError('Erreur', 'Les horaires pour le ' . $day . ' sont mal formatés.', ERROR_ALERT);
                    $this->redirect('../location/createLocation');
                    exit;
                }
            }
        }

        // Vérifier que le tableau d'images est correctement formaté
        $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif', 'svg');
        $images = array();

        if (!empty($_FILES['images'])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $file_name = $_FILES['images']['name'][$key];
                $file_size = $_FILES['images']['size'][$key];
                $file_tmp = $_FILES['images']['tmp_name'][$key];
                $file_type = $_FILES['images']['type'][$key];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                if (!in_array($file_ext, $allowed_extensions)) {

                    $this->setError('Erreur', 'Le format du fichier ' . $file_name . ' n\'est pas autorisé (formats autorisés : ' . implode(", ", $allowed_extensions) . ').', ERROR_ALERT);
                    $this->redirect('../location/createLocation');
                    exit;
                }

                if ($file_size > 10485760) {
                    $this->setError('Erreur', 'Le fichier ' . $file_name . ' est trop volumineux (10 Mo maximum).', ERROR_ALERT);
                    $this->redirect('../location/createLocation');
                    exit;
                }

                $file_name = $user_id . md5($file_name . time()) . '.' . $file_ext;
                array_push($images, $file_name);
            }
        }

        $i = 0;
        foreach ($images as $image) {
           move_uploaded_file($_FILES['images']['tmp_name'][$i], 'assets/images/location/' . $image);
            $i++;
        }

        $opening_hours = array();

        foreach ($days as $day) {
            $opening_hours[$day] = array(
                'day' => $day,
                'morning_opening' => $_POST['opening_hours_morning_' . $day],
                'morning_closing' => $_POST['closing_hours_morning_' . $day],
                'afternoon_opening' => $_POST['opening_hours_afternoon_' . $day],
                'afternoon_closing' => $_POST['closing_hours_afternoon_' . $day]
            );

            if (
                empty($_POST['opening_hours_morning_' . $day]) && empty($_POST['opening_hours_afternoon_' . $day])
                && empty($_POST['closing_hours_morning_' . $day]) && empty($_POST['closing_hours_afternoon_' . $day])
            ) {
                unset($opening_hours[$day]);
            }
        }

        $location = array(
            'name' => $name,
            'address' => $address,
            'is_open' => $is_open,
            'available_to_rental' => $available_to_rental,
            'price_day' => $price_day,
            'price_half_day' => $price_half_day,
            'id_users' => $user_id,
        );


        $this->loadModel('Location');

        $id = $this->_model->addLocation($location);

        if ($id === false) {
            $this->setError('Erreur', 'Une erreur est survenue lors de l\'ajout du site.', ERROR_ALERT);
            $this->redirect('../location/createLocation');
            exit;
        }

        $this->loadModel('OpeningHours');

        
        foreach ($opening_hours as $opening_hour) {
            
            $id_opening = $this->_model->addOpeningHours($opening_hour['day'], $opening_hour['morning_opening'], $opening_hour['morning_closing']);
            $this->_model->addOpensAt($id, $id_opening);

            $id_opening = $this->_model->addOpeningHours($opening_hour['day'], $opening_hour['afternoon_opening'], $opening_hour['afternoon_closing']);
            $this->_model->addOpensAt($id, $id_opening);
        }

        $this->loadModel('Images');
        foreach ($images as $image) {
            $this->_model->addImage($image, $id);
        }

        $this->setError('Succès', 'Le site a bien été ajouté.', SUCCESS_ALERT);
        $this->redirect('../location/createLocation');
        exit;

    }   

}
