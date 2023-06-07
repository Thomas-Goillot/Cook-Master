<?php

namespace Controllers;

use App\Controller;
use App\StripePayment;

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

        $orderId = uniqid();

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

        if ($this->isSubscription(MASTER_SUBSCRIPTION) && $typeSubscription === 'yearly') {

            $diff = $sum * 0.1;
            $sum = $sum - $diff;

            $sum = round($sum, 2);
            $diff = round($diff, 2);

            array_push($allProduct, array('name' => 'Réduction de 10%', 'description' => 'Réduction de 10% sur votre commande grâce à votre abonnement', 'price_purchase' => -$diff, 'quantity' => 1, 'allow_purchase' => 0));
        }



        $tva = $sum * TVA;
        $priceWithoutTva = $sum - $tva;

        $_SESSION['price_subscription'] = $sum;

        $pathToPayment = "UserSubscription/pay/". $subscriptionInfo['id_subscription']."/".$typeSubscription;

        $page_name = array("Abonnements" => $this->default_path, "Choix de la périodicité" => "UserSubscription/frequency", "Récapitulatif de la commande" => "UserSubscription/recap");

        $this->render('shop/invoiceRecap', compact('page_name', 'allProduct', 'sum', 'user', 'orderId', 'tva', 'priceWithoutTva', 'pathToPayment'), DASHBOARD);


    }

    public function pay():void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $idSubscription = (int) $params[0];
        $typeSubscription = $params[1];

        $idUser = $this->getUserId();

        $this->loadModel("User");

        $email = $this->_model->getUserInfo($idUser)['email'];


        $this->loadModel('Subscription');

        $subscriptionInfo = $this->_model->getAllSubscriptionInfoById($idSubscription)[0];


        $data = array(array(
            "name" => "Abonnement " . $subscriptionInfo['name'],
            "price_purchase" => $_SESSION['price_subscription'],
            "id" => $subscriptionInfo['id_subscription'],
            "quantity" => 1,
            "description" => "Abonnement " . $subscriptionInfo['name'] . " " . $typeSubscription . " " . $_SESSION['price_subscription'] . "€/mois",
            "allow_purchase" => 0
        ));

        $payment = new StripePayment(STRIPE_API_KEY);

        if($typeSubscription === 'monthly'){
            // monthly
            $payment->startPayment($data, $email, $this->activeSecurity("UserSubscription/success",array("typeSubscription" => 1, "idSubscription" => $subscriptionInfo['id_subscription']))['url'], $this->activeSecurity("UserSubscription/cancel")['url']);
        }else{
            // yearly
            $payment->startPayment($data, $email, $this->activeSecurity("UserSubscription/success", array("typeSubscription" => 2, "idSubscription" => $subscriptionInfo['id_subscription']))['url'], $this->activeSecurity("UserSubscription/cancel")['url']);
        }

        $_SESSION['price_subscription'] = null;
        unset($_SESSION['price_subscription']);

    }

    public function success():void{
        if($this->checkSecurity()){

            $page_name = array("Abonnements" => $this->default_path, "Choix de la périodicité" => "UserSubscription/frequency", "Récapitulatif de la commande" => "UserSubscription/recap", "Merci pour votre achat" => "UserSubscription/success");

            $infos = $this->getSecurityParams();

            $this->loadModel('Subscription');

            $subscriptionInfo = $this->_model->getAllSubscriptionInfoById($infos['idSubscription']);

            $this->loadModel('UserSubscription');

            $this->_model->updateSubscriptionToUser($this->getUserId(), $infos['idSubscription'], $infos['typeSubscription']);

            

            $this->render('shop/successPayment', compact('page_name','infos', 'subscriptionInfo'), DASHBOARD);
        }
        else{
            $this->setError("Erreur", "Une erreur est survenue lors du payment", ERROR_ALERT);
            $this->redirect('../../../UserSubscription/information');
        }


    }




    

}