<?php

namespace Controllers;

use App\Controller;
use App\StripePayment;
class cookLocation extends Controller
{
    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "cookLocation/cookLocation";

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
     * Display the cookLocation page
     * @return void
     */
    public function cookLocation(): void
    {
        $this->loadModel('CookLocation');
        $cookLocations = $this->_model->getAllCookLocationsWithInfo();

        $page_name = array("Louer un cuisine" => $this->default_path);
        $this->render('cookLocation/cookLocation', compact('page_name','cookLocations'), DASHBOARD);
    }

    /**
     * Display the cookLocationDisplay page
     * @return void
     */
    public function cookLocationDisplay(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_location = (int) $params[0];



        $this->loadModel('cookLocation');

        $cookLocations = $this->_model->getLocationInfoById($id_location);

        

        $page_name = array("Location de cuisine"=> $this->default_path);

        $this->render('cookLocation/cookLocationDisplay', compact('page_name','cookLocations'), DASHBOARD, '../../');
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

        echo $this->generateFile('views/cookLocation/hours.php', compact('location', 'days'));
    }



    /**
     * add reservationCookLocation
     * @return void
     */
    public function pay(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $this->loadModel('User');

        $datetime = date('Y-m-d H:i:s');

        $id_users = $this->_model->getUserInfo($this->getUserId());
        $id_location = (int) $params[0];
        $location = $this->_model->getLocationInfoById($id_location);

        $start_rental = $_POST['start_rental'];
        $date_reservation = $_POST['date_reservation'];
        $end_rental = $_POST['end_rental'];

        $user = $this->_model->getUserInfo($id_users);

        $userEmail = $user['email'];


        
        

        $eventData = array(array(
            "name" => $location['name'],
            "start_rental" => $start_rental,
            "date_reservation" => $date_reservation,
            "end_rental" => $end_rental,
            "price_purchase" => $location['price']
        ));

        if($start_rental < $datetime){
            $this->redirect('cookLocation/cookLocationDisplay/' . $id_location);
            $this->setError('Erreur','La date de début de réservation ne peux pas être inférieur à la date actuel');
            exit();
        }
        if($end_rental < $datetime){
            $this->redirect('cookLocation/cookLocationDisplay/' . $id_location);
            $this->setError('Erreur','La date de fin de réservation ne peux pas être inférieur à la date actuel');
            exit();
        }

        $payment = new StripePayment(STRIPE_API_KEY);

        $payment->startPayment($eventData, $userEmail, $this->activeSecurity("WorkshopPresentation/paySuccess", array("id_location" => $id_location))['url']);
    }



    /**
     * pay success
     * @return void
     */
    public function paySuccess(): void
    {
        if ($this->checkSecurity()) {

            $data = $this->getSecurityParams();
            
            $id_location =(int) $data['id_workshop'];

            $id_user = (int) $this->getUserId();
            
            $this->loadModel("cookLocation");

            $this->setError("Bravo !", "Votre cuisine a bien été réservé.", SUCCESS_ALERT);
            $this->redirect("../../../CookLocation");
        } else {
            $this->setError("Mince !", "Une erreur est survenue lors de la réservation de la cuisine. Veuillez réessayer.", WARNING_ALERT);
            $this->redirect("../../../CookLocation");
        }
    }


    
    /**
     * add reservationCookLocation
     * @return void
     */
    public function reservationCookLocation(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $this->loadModel('User');

        $datetime = date('Y-m-d H:i:s');

        $id_users = $this->_model->getUserInfo($this->getUserId());
        $id_location = (int) $params[0];

        $start_rental = $_POST['start_rental'];
        $date_reservation = $_POST['date_reservation'];
        $end_rental = $_POST['end_rental'];


        if($start_rental < $datetime){
            $this->redirect('cookLocation/cookLocationDisplay/' . $id_location);
            $this->setError('Erreur','La date de début de réservation ne peux pas être inférieur à la date actuel');
            exit();
        }
        if($end_rental < $datetime){
            $this->redirect('cookLocation/cookLocationDisplay/' . $id_location);
            $this->setError('Erreur','La date de fin de réservation ne peux pas être inférieur à la date actuel');
            exit();
        }
        

        $this->loadModel('reservationCookLocation');

        $this->_model->addReservationCookLocation($id_users, $id_location,  $start_rental, $date_reservation,$end_rental);

        $this->redirect('cookLocation/pay');

    }


}