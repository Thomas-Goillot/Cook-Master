<?php

namespace Controllers;

use App\Controller;

class Admin extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "admin/users";

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

    /**
     * Display the user profil page
     *
     * @return void
     */
    public function users(): void
    {
        $users = $this->_model->getAll();

        $page_name = array("Admin" => "", "Utilisateurs" => "admin/users");

        $this->render($this->default_path, compact('users', 'page_name'), DASHBOARD);
    }

    /**
     * Display the Subscription page
     *
     * @return void
     */
    public function subscription(): void
    {

        $this->loadModel('Subscription');

        $subscriptionsNumber = $this->_model->getAllSubscriptionNumberOfSubscribe();
        $subscriptionOption = $this->_model->getAllSubscriptionOption();
        $rewards = $this->_model->getAllSubscriptionRewards();
        $shippingTypes = $this->_model->getAllSubscriptionShippingType();
        $subscriptionAllInfo = $this->_model->getAllSubscriptionInfo();

        $numberOfSubscriptionAllInfo = count($subscriptionAllInfo);

        $page_name = array("Admin" => $this->default_path, "Abonnements" => "admin/subscription");

        $this->render('admin/subscription', compact('subscriptionsNumber', 'numberOfSubscriptionAllInfo', 'subscriptionOption', 'rewards', 'subscriptionAllInfo', 'shippingTypes', 'page_name'), DASHBOARD);
    }

    /**
     * Display the Product page
     * @return void
     */
    public function products(): void
    {
        $this->loadModel("Products");

        
        $allProduct = $this->_model->getAllProducts();

        $page_name = array("Admin" => $this->default_path, "Produits" => "admin/products");

        $this->render('admin/products', compact('allProduct', 'page_name'), DASHBOARD);
    }

    /**
     * Check before add a product in the database
     * @return void
     */
    public function addProduct(): void
    {
        if (!isset($_POST['submit'])) {

            // if( isset($_POST['name']) || isset($_POST['description']) || isset($_POST['image']) ) {
            //     $this->setError('Champs non valide',"Veuillez remplir tout les champs.",ERROR_ALERT);
            //     $this->redirect('../admin/products');
            // }
            if (isset($_POST['dispnobilitySale'])) {
                $dispnobilitySale = 0;
            } else {
                $dispnobilitySale = 1;
            }
            if (isset($_POST['dispnobilityRental'])) {
                $dispnobilityRental = 0;
            } else {
                $dispnobilityRental = 1;
            }
            if (isset($_POST['dispnobilityEvent'])) {
                $dispnobilityEvent = 0;
            } else {
                $dispnobilityEvent = 1;
            }
            if (strlen($_POST['name']) > 100) {
                $this->setError('Nom du produit trop long',"Le nom du produit ne peut pas excéder 50 caractères.",ERROR_ALERT);
                $this->redirect('../admin/products');
            }
            // if (strlen($_POST['image']) > 50) {
            //     $this->setError('Nom de l\'image trop long',"Le nom de l\'image ne peut pas excéder 50 caractères.",ERROR_ALERT);
            //     $this->redirect('../admin/products');
            // }
            if (strlen($_POST['description']) > 500) {
                $this->setError('Description trop longue',"La description ne peut pas excéder 500 caractères.",ERROR_ALERT);
                $this->redirect('../admin/products');
            }
            if (strlen($_POST['dispnobilityStock']) < 1) {
                $this->setError('Quantité invalide',"La quantité du stock ne peux pas débuter à '0' ",ERROR_ALERT);
                $this->redirect('../admin/products');
            }


            

        $acceptable = ['image/jpeg, image/png'];
    
        // if(!in_array($_FILES['image']['type'], $acceptable)){
        //     $this->setError('Type de fichier non autorisée',"Les type de fichier autorisé sont :  .png et .jpeg",ERROR_ALERT);
        //     $this->redirect('../admin/products');
        // }
    
        $maxSize = 5 * 1024 * 1024; //5 Mo
        if($_FILES['image']['size'] > $maxSize){
            $this->setError('Fichier trop lourd',"la taille du fichier ne doit pas dépasser 5 Mo",ERROR_ALERT);
            $this->redirect('../admin/products');
        }
    
        //Si le dossier uploads n'existe pas, le créer
        $path = 'assets/images/productShop';
        if(!file_exists('assets/images/productShop/')){
            mkdir('assets/images/productShop/');
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
            $price_purchase = $_POST['price_purchase'];
            $price_rental = $_POST ['price_rental'];
            $dispnobilityStock = (int)$_POST['dispnobilityStock'];
            $id_users = $_SESSION['user']['id_users'];
            
            $this->loadModel("Products");

            $this->_model->addProduct($name, $description, $image, $dispnobilitySale, $dispnobilityRental, $dispnobilityEvent,$price_purchase,$price_rental, $dispnobilityStock, $id_users);
        }

        $this->redirect('../admin/products');
    }


        



    /**
     * update is ban user
     * @return void
     */
    public function updateIsBanUser(): void
    {
        $id_admin = (int) $_SESSION['user']['id_users'];
        $id = (int) $_GET['params'][0];

        if($id_admin === $id){
            $this->setError('Erreur', 'Vous ne pouvez pas vous bannir vous même', ERROR_ALERT);
            $this->redirect('../../admin/users');
            exit();
        }

        $this->loadModel('User');

        $user = $this->_model->checkUserExist($id);

        if ($user === false) {
            $this->setError('Erreur', "Cet utilisateur n\'existe pas", ERROR_ALERT);
            $this->redirect('../../admin/users');
            exit();
        }

        $is_banned = $this->_model->checkIsBanUserById($id);

        if($is_banned){
            $this->_model->updateIsBanUser($id, USER_IS_NOT_BANNED);
            $this->setError('Succès', "L\'utilisateur a été débanni", SUCCESS_ALERT);

        }
        else{
            $this->_model->updateIsBanUser($id, USER_IS_BANNED);
            $this->setError('Succès', "L\'utilisateur a été banni", SUCCESS_ALERT);
        }

        $this->redirect('../../admin/users');
    }

    /**
     * Display Event page
     * @return void
     */
    public function events(): void
    {
        $this->loadModel('EventsTemplate');
        $eventsTemplate = $this->_model->getAllEventTemplate();

        $this->loadModel('Events');
        $events = $this->_model->getAllEvents();

        foreach ($events as $key => $event) {
            $event['date_start'] = explode(" ", $event['date_start'])[0];
            $event['date_end'] = explode(" ", $event['date_end'])[0];

            $event['date_start'] = explode("-", $event['date_start']);
            $event['date_end'] = explode("-", $event['date_end']);
            //0 = year, 1 = month, 2 = day

            $events[$key]['date_start'] = array();
            $events[$key]['date_end'] = array();
            $events[$key]['date_start']['day'] = $event['date_start'][2];
            $events[$key]['date_start']['month'] = $event['date_start'][1]-1;
            $events[$key]['date_start']['year'] = $event['date_start'][0];

            $events[$key]['date_end']['day'] = $event['date_end'][2];
            $events[$key]['date_end']['month'] = $event['date_end'][1]-1;
            $events[$key]['date_end']['year'] = $event['date_end'][0];

        }

        $page_name = array("Admin" => $this->default_path, "Listes des Évènements" => "admin/events");

        $this->setJsFile(array('events.js'));

        $this->render('admin/events', compact('eventsTemplate','events', 'page_name'), DASHBOARD);
    }

    /**
     * Display the eventsTemplate page
     * @return void
     */
    public function eventsTemplate(): void
    {

        $this->loadModel('EventsTemplate');

        $eventsTemplate = $this->_model->getAllEventTemplate();

        $page_name = array("Admin" => $this->default_path, "Évènements" => "admin/events", "Modèles d'évènements" => "admin/eventsTemplate");

        $this->render('admin/eventsTemplate', compact('eventsTemplate', 'page_name'), DASHBOARD);
    }

    /**
     * Edit event page
     * @return void
     */
    public function editEvent(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_event = (int) $params[0];

        $this->loadModel('Events');

        $eventInfo = $this->_model->getEventById($id_event);

        $eventInfo['date_start'] = explode(" ", $eventInfo['date_start'])[0];
        $eventInfo['date_end'] = explode(" ", $eventInfo['date_end'])[0];
        
        $eventInfo['date_start'] = explode("-", $eventInfo['date_start']);
        $eventInfo['date_end'] = explode("-", $eventInfo['date_end']);
        $eventInfo['date_start'] = $eventInfo['date_start'][2] . "/" . $eventInfo['date_start'][1] . "/" . $eventInfo['date_start'][0];
        $eventInfo['date_end'] = $eventInfo['date_end'][2] . "/" . $eventInfo['date_end'][1] . "/" . $eventInfo['date_end'][0];


        $page_name = array("Admin" => $this->default_path, "Évènements" => "admin/events", "Modification de ".$eventInfo['name'] => "admin/events");

        $this->render('admin/editEvent', compact('eventInfo', 'page_name'), DASHBOARD, "../../");
    }


    /** Default path to the view
     * 
     */
    public function recipesAdmin(): void
    {
        $page_name = array("Admin" => $this->default_path, "Recettes" => "admin/recipesAdmin");

        $this->render('admin/recipesAdmin', compact('page_name'), DASHBOARD);
    }


}
