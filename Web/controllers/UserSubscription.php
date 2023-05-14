<?php

namespace Controllers;

use App\Controller;

class UserSubscription extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "UserSubscription/information";

    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }
    }

    /**
     * Display the user subscription page list of all subscription 
     */
    public function information():void
    {
        $this->loadModel('Subscription');

        $subscriptionsNumber = $this->_model->getAllSubscriptionNumberOfSubscribe();
        $subscriptionOption = $this->_model->getAllSubscriptionOption();
        $rewards = $this->_model->getAllSubscriptionRewards();
        $shippingTypes = $this->_model->getAllSubscriptionShippingType();
        $subscriptionAllInfo = $this->_model->getAllSubscriptionInfo();

        $numberOfSubscriptionAllInfo = count($subscriptionAllInfo);

        $page_name = array("Abonnements" => $this->default_path);

        $this->render('subscription/userPricing', compact('subscriptionsNumber', 'numberOfSubscriptionAllInfo', 'subscriptionOption', 'rewards', 'subscriptionAllInfo', 'shippingTypes', 'page_name'), DASHBOARD);
    }

    public function frequency():void{

        $idSubscription = htmlspecialchars($_POST['id_subscription']);

        if (!is_numeric($idSubscription)) {
            $this->setError("Erreur", "Une erreur est survenue", ERROR_ALERT);
            $this->redirect('../UserSubscription/information');
        }

        $this->loadModel('Subscription');

        $subscriptionInfo = $this->_model->getAllSubscriptionInfoById($idSubscription)[0];


            

        $page_name = array("Abonnements" => $this->default_path, "Fréquence d'abonnement" => "UserSubscription/frequency");

        $this->render('subscription/userFrequency', compact('page_name', 'subscriptionInfo'), DASHBOARD);
    }



    public function recap():void{

        $idUser = $this->getUserId();

        $this->loadModel("User");

        $user = $this->_model->getUserInfo($idUser);

        if (empty($user['address']) || empty($user['city']) || empty($user['zip_code']) || empty($user['country'])) {
            $this->setError("Erreur", "Veuillez renseigner votre adresse dans votre profil", ERROR_ALERT);
            $this->redirect('../users/editProfil');
        }

        $idSubscription = htmlspecialchars($_POST['idSubscription']);
        $typeSubscription = htmlspecialchars($_POST['typeSubscription']);
        
        if (!is_numeric($idSubscription)) {
            $this->setError("Erreur", "Une erreur est survenue", ERROR_ALERT);
            $this->redirect('../UserSubscription/information');
        }

        $this->loadModel('Subscription');

        $subscriptionInfo = $this->_model->getAllSubscriptionInfoById($idSubscription)[0];

        if(!$subscriptionInfo['id_subscription']){
            $this->setError("Erreur", "Une erreur est survenue", ERROR_ALERT);
            $this->redirect('../UserSubscription/information');
        }

        $availableTypeSubscription = ['monthly', 'yearly'];
        if(!in_array($typeSubscription, $availableTypeSubscription)){
            $this->setError("Erreur", "Une erreur est survenue", ERROR_ALERT);
            $this->redirect('../UserSubscription/information');
        }

        $userCartId = uniqid();

        $allProduct = array(
            array(
                "name" => "Abonnement " . $subscriptionInfo['name'],
                "price_purchase" => $subscriptionInfo['price_' . $typeSubscription],
                "id" => $subscriptionInfo['id_subscription'],
                "quantity" => 1,
                "description" => "Abonnement " . $subscriptionInfo['name'] . " " . $typeSubscription . " " . $subscriptionInfo['price_' . $typeSubscription] . "€/mois",
                "allow_purchase" => 0
            )
        );


        $sum = $subscriptionInfo['price_' . $typeSubscription];


        $tva = $sum * TVA;
        $priceWithoutTva = $sum - $tva;

        $pathToPayment = "UserSubscription/payment";

        $page_name = array("Abonnements" => $this->default_path, "Choix de la périodicité" => "UserSubscription/frequency", "Récapitulatif de la commande" => "UserSubscription/recap");

        $this->render('shop/invoiceRecap', compact('page_name', 'allProduct', 'sum', 'user', 'userCartId', 'tva', 'priceWithoutTva', 'pathToPayment'), DASHBOARD);


    }



    

}