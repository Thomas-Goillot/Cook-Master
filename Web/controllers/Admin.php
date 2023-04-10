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

        var_dump($_POST);
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
            // if (strlen($_POST['name']) > 100)) {
            //     $this->redirect('../admin/products');
            // }
            // if (strlen($_POST['image']) > 50) {
            //     $this->redirect('../admin/products');
            // }
            // if ($_POST['dispnobilityStock'] < 1) {
            //     $this->redirect('../admin/products');
            // }
            $name = $_POST['name'];
            $description = $_POST['description'];
            $image = $_POST['image'];
            $dispnobilityStock = (int)$_POST['dispnobilityStock'];
            $id_users = $_SESSION['user']['id_users'];

            $this->loadModel("Products");

            $this->_model->addProduct($name, $description, $image, $dispnobilitySale, $dispnobilityRental, $dispnobilityEvent, $dispnobilityStock, $id_users);
        }

        $this->redirect('../admin/products');
    }
}
