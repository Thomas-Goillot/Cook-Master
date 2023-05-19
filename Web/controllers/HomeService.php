<?php

namespace Controllers;

use App\Controller;

class HomeService extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "homeService/index"; 
   
    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

    }
    
    /**
     * Display the joinRequest page
     * @return void
     */ 
    public function index(): void
    {
        $this->loadModel('User');

        $user = $this->_model->getUserInfo($_SESSION['user']['id_users']);

        $this->loadModel("HomeService");

        $getAllEntrancesWithoutIngredients = $this->_model->getAllEntrancesWithoutIngredients();

        $getAllDishesWithoutIngredients = $this->_model->getAllDishesWithoutIngredients();

        $getAllDessertsWithoutIngredients = $this->_model->getAllDessertsWithoutIngredients();

        $this->setJsFile(array('location.js'));
        
        $this->setCssFile(array('css/location/location.css'));

        $page_name = array("Prestation à domicile" => "homeService/index");

        $address = $user["address"] .= ", ";

        $address .= $user["city"];

        $address  .= " ";

        $address .= $user["zip_code"];

        $this->render("homeService/index", compact('address','user','getAllEntrancesWithoutIngredients','getAllDishesWithoutIngredients','getAllDessertsWithoutIngredients','page_name'), DASHBOARD);
    }

    /**
     * Add a request
     * @return void
     */ 
    public function sendRequest(): void
    {
        if (!isset($_POST['submit'])) {
            $defaultFallBack = '../homeService';

            $nb_places = htmlspecialchars($_POST['couverts']);

            $type_home_services = htmlspecialchars($_POST['customRadio']);

            $type_equipment = htmlspecialchars($_POST['customRadio1']);

            $type_nourriture = htmlspecialchars($_POST['customRadio2']);
            
            $id_users = $this->getUserId();

            $id_recipes = htmlspecialchars($_POST['Entrances']);

            $id_recipes_1 = htmlspecialchars($_POST['Dishes']);

            $id_recipes_2 = htmlspecialchars($_POST['Desserts']);

            if (empty($id_recipes) || empty($id_recipes_1) || empty($id_recipes_2)) {
                $this->setError("Echec","Merci de préciser les plats", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (empty($type_home_services)) {
                $this->setError("Echec","Selectionnez un type de prestation", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (empty($type_equipment)) {
                $this->setError("Echec","Selectionnez un type d'équipement", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (empty($type_nourriture)) {
                $this->setError("Echec","Selectionnez la nourriture souahaitée", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (empty($nb_places)) {
                $this->setError("Echec","Selectionnez le nombre de personnes", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            $this->loadModel("HomeService");


            $this->_model->sendRequest($nb_places, $type_home_services, $type_equipment, $type_nourriture, $id_users, $id_recipes, $id_recipes_1, $id_recipes_2);
        }
        $this->setError("Achat effectué !", "Votre demande a bien été prise en compte !", SUCCESS_ALERT);
        $this->redirect($defaultFallBack);
    }

}
