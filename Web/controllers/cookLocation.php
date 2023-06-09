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
        $this->render('cookLocation/cookLocation', compact('page_name', 'cookLocations'), DASHBOARD);
    }

    /**
     * Display the cookLocationDisplay page
     * @return void
     */
    public function cookLocationDisplay(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 ) {
            $this->redirect('../home');
            exit();
        }

        $id_location = (int) $params[0];



        $this->loadModel('cookLocation');

        $cookLocations = $this->_model->getLocationInfoById($id_location);



        $page_name = array("Location de cuisine" => $this->default_path);

        $this->render('cookLocation/cookLocationDisplay', compact('page_name', 'cookLocations'), DASHBOARD, '../../');
    }


    /**
     * ajax request to get the location view
     * @return void
     */
    public function getlocationWithView(): void
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


        if (count($params) === 0 ) {
            $this->redirect('../home');
            exit();
        }
        $id_location = (int) $params[0];

        $this->loadModel('User');

        $isValid = false;

        $id_users = $this->getUserId();

        $user = $this->_model->getUserInfo($id_users);

        $this->loadModel('CookLocation');

        $location = $this->_model->getLocationInfoById($id_location);
        $date_reservation = $_POST['date_reservation'];
        $price = $_POST['price'];

        $userEmail = $user['email'];

        $dateReservation = $_POST['date_reservation'];


        list($start_rental, $end_rental) = explode(' - ', $dateReservation);


        $startTimestamp = strtotime(str_replace('/', '-', $start_rental));
        $endTimestamp = strtotime(str_replace('/', '-', $end_rental));
        $currentTimestamp = time();

       $defaultFallBack = '../../cookLocation/cookLocationDisplay/' . $id_location;

        if ($startTimestamp < $currentTimestamp) {
            $this->setError('Erreur', 'La date de début de réservation ne peut pas être antérieure à la date actuelle', ERROR_ALERT);
            $this->redirect($defaultFallBack);
            exit();
        }
        
        if ($endTimestamp < $currentTimestamp) {
            $this->setError('Erreur', 'La date de fin de réservation ne peut pas être antérieure à la date actuelle', ERROR_ALERT);
            $this->redirect($defaultFallBack);
            exit();
        }


        $startTimestamp = strtotime(str_replace('/', '-', $start_rental));
        $endTimestamp = strtotime(str_replace('/', '-', $end_rental));


        $startDay = date('l', $startTimestamp);
        $endDay = date('l', $endTimestamp);


        $openingDays = array_column($location['opening_hours'], 'opening_day');

        if (!in_array($startDay, $openingDays) || !in_array($endDay, $openingDays)) {
            $this->setError('Erreur', 'La réservation n\'est pas disponible pour le jour sélectionné : ' . $startDay, ERROR_ALERT);
            $this->redirect($defaultFallBack);
            exit();
        }

        $locationData = array(array(
            "name" => $location['name'],
            "start_rental" => $start_rental,
            "date_reservation" => $date_reservation,
            "end_rental" => $end_rental,
            "price_purchase" => $price
        ));

        $data = array(array(
            "name" => $location['name'],
            "price_purchase" => $price,
            "id" => "online",
            "quantity" => 1,
            "description" => "Location d'une cuisine",
            "allow_purchase" => 0
        ));

        $payment = new StripePayment(STRIPE_API_KEY);

        $payment->startPayment($data, $userEmail, $this->activeSecurity("cookLocation/paySuccess", array("id_location" => $id_location, "start_rental" => $start_rental, "end_rental" => $end_rental))['url']); 
    }



    /**
     * pay success
     * @return void
     */
    public function paySuccess(): void
    {

        if ($this->checkSecurity()) {

            $data = $this->getSecurityParams();

            $id_location = (int) $data['id_location'];
            $start_rental = $data['start_rental'];
            $end_rental = $data['end_rental'];

            $start_rental = date("Y-m-d", strtotime(str_replace('/', '-', $start_rental)));
            $end_rental = date("Y-m-d", strtotime(str_replace('/', '-', $end_rental)));

            $id_user = (int) $this->getUserId();
            
            $this->loadModel("cookLocation");

            $this->_model->reservationCookLocation($id_user, $id_location, $start_rental,$end_rental);

            $this->setError("Bravo !", "Votre cuisine a bien été réservé.", SUCCESS_ALERT);
            $this->redirect("../../CookLocation/CookLocation");
        } else {
            $this->setError("Mince !", "Une erreur est survenue lors de la réservation de la cuisine. Veuillez réessayer.", WARNING_ALERT);
            $this->redirect("../../CookLocation/CookLocation");
        }
    }


}
