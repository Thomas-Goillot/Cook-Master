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
                $this->redirect('../admin/products');
            }
            // if (strlen($_POST['image']) > 50) {
            //     $this->redirect('../admin/products');
            // }
            if (strlen($_POST['description']) > 50) {
                $this->redirect('../admin/products');
            }
            if ($_POST['dispnobilityStock'] < 1) {
                $this->redirect('../admin/products');
            }


            

        $acceptable = ['image/jpeg, image/png'];
    
        if(!in_array($_FILES['image']['type'], $acceptable)){
            $this->setError('Type de fichier non autorisée',"Ce type de fichier n\'est pas autorisé",'ERROR_ALERT');
            $this->redirect('../admin/products');
        }
    
        $maxSize = 5 * 1024 * 1024; //5 Mo
        if($_FILES['image']['size'] > $maxSize){
            $this->redirect('../admin/products');
        }
    
        //Si le dossier uploads n'existe pas, le créer
        $path = 'assets/images/productShop';
        if(!file_exists('assets/images/productShop/')){
            mkdir('assets/images/productShop/');
        }

        $filename = $_FILES['image']['name'];
    
        $array = explode('.', $filename);
        //rename file
        $extension = end($array);
    
        $filename = 'image-' . time() . '.' . $extension;
    
        $destination = $path . '/' . $filename;
    
        // var_dump($_FILES);
        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
    

            $name = $_POST['name'];
            $description = $_POST['description'];
            $image = $filename;
            $dispnobilityStock = (int)$_POST['dispnobilityStock'];
            $id_users = $_SESSION['user']['id_users'];


            $this->loadModel("Products");

            $this->_model->addProduct($name, $description, $image, $dispnobilitySale, $dispnobilityRental, $dispnobilityEvent, $dispnobilityStock, $id_users);
        }

        // $this->redirect('../admin/products');
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
}
