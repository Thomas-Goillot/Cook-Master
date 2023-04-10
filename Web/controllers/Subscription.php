<?php

namespace Controllers;

use App\Controller;

class Subscription extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "subscription";

    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

        $this->loadModel('User');

        $id_access = $this->_model->getAll();

        $id_access = (int) $id_access[0]['id_access'];

        if ($this->isAdmin($id_access) === false) {
            $this->redirect('../home');
            exit();
        }
    }

    /**
     * Display Edit subscription page
     * @return void
     */
    public function edit(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_subscription = (int) $params[0];

        $this->default_path = "../subscription/edit/$id_subscription";

        $this->loadModel('Subscription');

        $subscriptionAllInfo = $this->_model->getAllSubscriptionInfoById($id_subscription);

        if ($subscriptionAllInfo[0]['is_active'] == 1) {
            $subscriptionAllInfo[0]['is_active_checked'] = 'checked';
        } else {
            $subscriptionAllInfo[0]['is_active_checked'] = '';
        }

        $numberOfSubscriptionAllInfo = count($subscriptionAllInfo);

        $page_name = array("Admin" => "", "Abonnements" => "admin/subscription", "Modification de " . $subscriptionAllInfo[0]['name'] . "" => "subscription/edit/$id_subscription");

        $this->render('subscription/edit', compact('subscriptionAllInfo', 'numberOfSubscriptionAllInfo', 'page_name'), DASHBOARD, '../../');
    }

    /**
     * Update a subscription
     * @return void
     */
    public function update(): void
    {

        $subscriptionId = htmlspecialchars($_POST['SubscriptionId']);
        $defaultFallback = "../subscription/edit/$subscriptionId";

        if (!isset($_POST)) {
            $this->setError('Erreur', "Une erreur est survenue lors de la modification de l\'abonnement", ERROR_ALERT);
            $this->redirect($defaultFallback);
            exit();
        }

        if (!isset($_POST['SubscriptionName']) || !isset($_POST['SubscriptionAccessToLessons']) || !isset($_POST['SubscriptionPriceMonthly']) || !isset($_POST['SubscriptionPriceYearly']) || !isset($_POST['SubscriptionId'])) {
            $this->setError('Erreur', "Tout les champs n\'ont pas été remplis", ERROR_ALERT);
            $this->redirect($defaultFallback);
            exit();
        }

        $subscriptionName = htmlspecialchars($_POST['SubscriptionName']);
        $subscriptionAccessToLessons = htmlspecialchars($_POST['SubscriptionAccessToLessons']);
        $subscriptionPriceMonthly = htmlspecialchars($_POST['SubscriptionPriceMonthly']);
        $subscriptionPriceYearly = htmlspecialchars($_POST['SubscriptionPriceYearly']);

        if (!isset($_POST['SubscriptionActive'])) {
            $subscriptionActive = 0;
        } else {
            $subscriptionActive = 1;
        }

        if (strlen($subscriptionName) > MAX_SUBSCRIPTION_NAME) {
            $this->setError('Erreur', "Le nom de l\'abonnement est trop long", ERROR_ALERT);
            $this->redirect($defaultFallback);
            exit();
        }

        if ($subscriptionAccessToLessons < MIN_ACCESS_TO_LESSONS) {
            $this->setError('Erreur', "Le nombre de leçons est trop petit", ERROR_ALERT);
            $this->redirect($defaultFallback);
            exit();
        }

        if ($subscriptionPriceMonthly < MIN_SUBSCRIPTION_PRICE) {
            $this->setError('Erreur', "Le prix mensuel est trop petit", ERROR_ALERT);
            $this->redirect($defaultFallback);
            exit();
        }

        if ($subscriptionPriceYearly < MIN_SUBSCRIPTION_PRICE) {
            $this->setError('Erreur', "Le prix annuel est trop petit", ERROR_ALERT);
            $this->redirect($defaultFallback);
            exit();
        }

        $this->loadModel('Subscription');

        $respons = $this->_model->updateSubscription($subscriptionId, $subscriptionName, $subscriptionAccessToLessons, $subscriptionPriceMonthly, $subscriptionPriceYearly, $subscriptionActive);

        if ($respons === false) {
            $this->redirect($defaultFallback);
            exit();
        }

        $this->setError('Succès', "L\'abonnement a bien été modifié", SUCCESS_ALERT);
        $this->redirect('../admin/subscription');
    }

    /**
     * Display Create subscription page
     * @return void
     */
    public function create(): void
    {
        $this->loadModel('Subscription');

        $allSubscriptionOption = $this->_model->getAllSubscriptionOption();
        $allSubscriptionRenewalBonus = $this->_model->getAllSubscriptionRenewalBonus();
        $allSubscriptionShippingType = $this->_model->getAllSubscriptionShippingType();
        $allSubscriptionRewards = $this->_model->getAllSubscriptionRewards();

        $page_name = array("Admin" => "", "Abonnements" => "admin/subscription", "Création d'un abonnement" => "subscription/create");

        $this->render('subscription/create', compact('allSubscriptionOption', 'allSubscriptionRenewalBonus', 'allSubscriptionShippingType', 'allSubscriptionRewards', 'page_name'), DASHBOARD, '../');
    }

    /**
     * Create a subscription
     * @return void
     */
    public function store(): void
    {
        $defaultFallback = 'subscription/create';

        if (!isset($_POST)) {
            $this->redirect($defaultFallback);
            exit();
        }

        if(!isset($_POST['SubscriptionName']) || !isset($_POST['SubscriptionAccessToLessons']) || !isset($_POST['SubscriptionPriceMonthly']) || !isset($_POST['SubscriptionPriceYearly']) || !isset($_POST['SubscriptionIcon']) || !isset($_POST['SubscriptionShippingType']) || !isset($_POST['SubscriptionRenewalBonus']) || !isset($_POST['SubscriptionOptions']) || !isset($_POST['SubscriptionRewards'])) {
            $this->redirect($defaultFallback);
            exit();
        }

        $subscriptionName = htmlspecialchars($_POST['SubscriptionName']);
        $subscriptionAccessToLessons = htmlspecialchars($_POST['SubscriptionAccessToLessons']);
        $subscriptionPriceMonthly = htmlspecialchars($_POST['SubscriptionPriceMonthly']);
        $subscriptionPriceYearly = htmlspecialchars($_POST['SubscriptionPriceYearly']);
        $subscriptionIcon = htmlspecialchars($_POST['SubscriptionIcon']);
        $subscriptionShippingType = $_POST['SubscriptionShippingType'];
        $subscriptionRenewalBonus = $_POST['SubscriptionRenewalBonus'];
        $subscriptionOption = $_POST['SubscriptionOptions'];
        $subscriptionRewards = $_POST['SubscriptionRewards'];
        $subscriptionActive = 1;

        if (strlen($subscriptionName) > MAX_SUBSCRIPTION_NAME) {
            $this->redirect($defaultFallback);
            exit();
        }

        if ($subscriptionAccessToLessons < MIN_ACCESS_TO_LESSONS) {
            $this->redirect($defaultFallback);
            exit();
        }

        if ($subscriptionPriceMonthly < MIN_SUBSCRIPTION_PRICE) {
            $this->redirect($defaultFallback);
            exit();
        }

        if ($subscriptionPriceYearly < MIN_SUBSCRIPTION_PRICE) {
            $this->redirect($defaultFallback);
            exit();
        }

        $this->loadModel('Subscription');

        $respons = $this->_model->createSubscription($subscriptionName, $subscriptionAccessToLessons, $subscriptionPriceMonthly, $subscriptionPriceYearly, $subscriptionRenewalBonus, $subscriptionActive, $subscriptionOption, $subscriptionShippingType, $subscriptionRewards, $subscriptionIcon);

        if ($respons === false) {
            $this->redirect($defaultFallback);
            exit();
        }

        $this->redirect('../admin/subscription');
    }
}
