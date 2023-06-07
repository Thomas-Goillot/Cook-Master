<?php

namespace Controllers;

use App\Controller;
use App\StripePayment;

class WorkshopPresentation extends Controller
{
    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "worshop/index";

    public function __construct()
    {
        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }
    }

    /**
     * Display the WorkshopPresentation page
     * @return void
     */
    public function index(): void
    {
        $this->loadModel("workshop");
        $allWorkshop = $this->_model->getAllWorkshopAvailable();

        foreach ($allWorkshop as $key => $value) {
            $allWorkshop[$key]['address'] = $this->_model->getWorkshopLocation($value['id_location']);
        }

        $page_name = array("Ateliers" => "WorkshopPresentation/index");

        $this->render('workshop/index', compact('page_name', 'allWorkshop'), DASHBOARD);
    }

    /**
     * display workshop page
     * @return void
     */
    public function workshopDisplay(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_workshop = (int) $params[0];

        $this->loadModel('Workshop');

        $workshop = $this->_model->getWorkshopById($id_workshop);

        $workshop['address'] = $this->_model->getWorkshopLocation($workshop['id_location']);

        $nbPlaceAvailable = $this->_model->getWorkshopPlaceById($id_workshop);

        $nbPlaceBooked = $this->_model->getWorkshopBookedPlace($id_workshop);

        if ($nbPlaceBooked == NULL) {
            $nbPlace = (int)$nbPlaceAvailable["nb_place"];
        } else {
            $nbPlace = (int)$nbPlaceAvailable["nb_place"] - $nbPlaceBooked["COUNT(id_workshop)"];
        }

        $page_name = array("Atelier" => "WorkshopPresentation", $workshop['name'] => "WorkshopPresentation/workshopDisplay/$id_workshop");

        $this->render('workshop/workshopDisplay', compact('page_name', 'id_workshop', 'workshop', 'nbPlace'), DASHBOARD, '../../');
    }

    /**
     * pay success
     * @return void
     */
    public function paySuccess(): void
    {
        //PROBLEME DE PATH JE COMPRENDS PAS POURQUOI LA REDIRECTION DEPUIS "pay" RENVOIE VERS "Workshop" et pas "WorkshopPresentation"
        echo "pay success";
/*         if ($this->checkSecurity()) {

            $data = $this->getSecurityParams();
            
            $id_workshop = $data['id_workshop'];
            $place = $data['nb_place'];
            $id_user = $this->getUserId();
            
            $this->loadModel("worshop");

            for ($i = 0; $i < $place; $i++) {
                $this->_model->reservationWorkshop($id_workshop, $id_user);
                $this->redirect("../../../personnalWorkshop");
            }
        } else {
            $this->setError("Mince !", "Une erreur est survenue lors de la réservation de votre atelier. Veuillez réessayer.", WARNING_ALERT);
            $this->redirect("../../../WorkshopPresentation");
        } */
    }

    /**
     * display the pay page for workshop
     * @return void
     */
    public function pay(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_workshop = $params[0];
        $place = $_POST['place'];

        $this->loadModel("User");

        $idUser = $this->getUserId();

        $user = $this->_model->getUserInfo($idUser);

        $userEmail = $user['email'];

        $this->loadModel("subscription");

        $subscription = $this->_model->getSubscriptionInfoById($idUser);

        $this->loadModel("workshop");

        $nbWorkshop = $this->_model->getNbWorkshopUserJoinById($idUser);

        if($subscription['access_to_lessons'] > $nbWorkshop['nb'] || $subscription['access_to_lessons'] == -1){

            $workshop = $this->_model->getWorkshopById($id_workshop);

            $eventData = array(array(
                "name" => $workshop['name'],
                "price_purchase" => $workshop['price'],
                "quantity" => $place
            ));

            $payment = new StripePayment(STRIPE_API_KEY);

            $payment->startPayment($eventData, $userEmail, $this->activeSecurity("WorkshopPresentation/paySuccess", array("id_event" => $id_workshop, "place" => $place))['url']);
        }
        else{
            $this->setError("Mince !", "Vous avez atteint le nombre maximum d\'ateliers que vous pouvez rejoindre avec votre abonnement actuel. Vous pouvez changer d\'abonnement dans votre espace personnel.", WARNING_ALERT);
            $this->redirect("../../WorkshopPresentation/workshopDisplay/$id_workshop");
        }
    }
}
