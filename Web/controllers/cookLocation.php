<?php

namespace Controllers;

use App\Controller;
use App\StripePayment;

class CookLocation extends Controller
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
     * Display the cookLocationInvoice page
     * @return void
     */
    public function cookLocationInvoice(): void
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
        $selectedPrice = trim($_POST['price']);

        if (trim($location['price_day']) === $selectedPrice) {
            $typeDay = 'Journée';
            $typeDayBdd = 0;
        } elseif (trim($location['price_half_day']) === $selectedPrice) {
            $typeDay = 'Demi-journée';
            $typeDayBdd = 1;
        }
        

        $userEmail = $user['email'];

        $dateReservation = $_POST['date_reservation'];


        list($start_rental, $end_rental) = explode(' - ', $dateReservation);


        $startTimestamp = strtotime(str_replace('/', '-', $start_rental));
        $endTimestamp = strtotime(str_replace('/', '-', $end_rental));
        $currentTimestamp = time();

        $numberOfDays = ($endTimestamp - $startTimestamp) / (60 * 60 * 24) + 1 ;

        $totalPrice = $price * $numberOfDays;
        
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

        $startDay = date('l', $startTimestamp);
        $endDay = date('l', $endTimestamp);


        $openingDays = array_column($location['opening_hours'], 'opening_day');

        if (!in_array($startDay, $openingDays) || !in_array($endDay, $openingDays)) {
            $this->setError('Erreur', "La réservation n\'est pas disponible pour le jour sélectionné : " . $startDay, ERROR_ALERT);
            $this->redirect($defaultFallBack);
            exit();
        };


        $start_rental = date('Y-m-d', $startTimestamp);
        $end_rental = date('Y-m-d', $endTimestamp);
        

        $this->_model->reservationCookLocation($id_users, $id_location, $start_rental, $end_rental, $typeDayBdd);

        $page_name = array("Location de cuisine" => $this->default_path);

        $this->render('cookLocation/cookLocationInvoice', compact('page_name', 'location','totalPrice','numberOfDays','price','typeDay','start_rental','end_rental'), DASHBOARD, '../../');
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

        $this->loadModel('User');

        $idLocation = (int) htmlspecialchars($params[0]);
        $idUsers = $this->getUserId();
        $defaultFallBack = '../../cookLocation/cookLocationDisplay/' . $idLocation;
        $userEmail = $this->_model->getUserInfo($idUsers)['email'];

        $this->loadModel('CookLocation');

        $location = $this->_model->getLocationInfoById($idLocation);

        if($location['id_location'] == NULL){
            $this->setError('Erreur', 'Pas cool de modifier le code!', ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        $rentLocationInfo = $this->_model->getRentLocationInfo($idUsers, $idLocation);

        
        list($start_rental, $end_rental) = explode(' - ', $rentLocationInfo['date_reservation']);


        $startTimestamp = strtotime(str_replace('/', '-', $rentLocationInfo['start_rental']));
        $endTimestamp = strtotime(str_replace('/', '-', $rentLocationInfo['end_rental']));
        
        $numberOfDays = ($endTimestamp - $startTimestamp) / (60 * 60 * 24) + 1 ;

        if($rentLocationInfo['type'] == 0){
            $price = $location['price_day'];
        }
        else{
            $price = $location['price_half_day'];
        }

        $totalPrice = $price * $numberOfDays;


        $data = array(array(
            "name" => $location['name'],
            "price_purchase" => $totalPrice,
            "id" => "online",
            "quantity" => 1,
            "description" => "Location d'une cuisine",
            "allow_purchase" => 0
        ));

        $payment = new StripePayment(STRIPE_API_KEY);

        $payment->startPayment($data, $userEmail, $this->activeSecurity("cookLocation/paySuccess", array("idRentLocation" => $rentLocationInfo['id_rent_location']))['url']); 
    }



    /**
     * pay success
     * @return void
     */
    public function paySuccess(): void
    {

        if ($this->checkSecurity()) {

            $data = $this->getSecurityParams();

            $idRentLocation = (int) $data['idRentLocation'];

            $idUser = (int) $this->getUserId();

            $this->loadModel('CookLocation');

            if(!$this->_model->updateStatus($idRentLocation, $idUser)){
                $this->setError("Mince !", "Une erreur est survenue lors de la réservation de la cuisine. Veuillez réessayer.", WARNING_ALERT);
                $this->redirect("../../CookLocation/CookLocation");
            }

            $this->setError("Bravo !", "Votre cuisine a bien été réservé.", SUCCESS_ALERT);
            $this->redirect("../../CookLocation/CookLocation");

        } else {
            $this->setError("Mince !", "Une erreur est survenue lors de la réservation de la cuisine. Veuillez réessayer.", WARNING_ALERT);
            $this->redirect("../../CookLocation/CookLocation");
        }
    }


}
