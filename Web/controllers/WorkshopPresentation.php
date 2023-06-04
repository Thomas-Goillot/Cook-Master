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

        foreach($allWorkshop as $key => $value){
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

        
        if($nbPlaceBooked == NULL){
            $nbPlace = (int)$nbPlaceAvailable["nb_place"];
            
        }else{
            $nbPlace = (int)$nbPlaceAvailable["nb_place"] - $nbPlaceBooked["COUNT(id_workshop)"];
        }


        $page_name = array("Atelier"=> $this->default_path, $workshop['name'] => "workshopDisplay/$id_workshop");

        $this->render('workshop/workshopDisplay', compact('page_name', 'id_workshop','workshop','nbPlace'), DASHBOARD, '../../');
    }



     /**
     * pay success
     * @return void
     */
    public function paySuccess(): void{
        
        
        
        if($this->checkSecurity()){
            $this->loadModel("worshop");
            $id_event = $this->getSecurityParams()['id_workshop'];
            $id_user = $this->getUserId();
            $place = (int) $this->getSecurityParams()['nb_place'];

            for($i = 0; $i < $place; $i++){
                $this->_model->reservationWorkshop($id_event,$id_user);
                $this->redirect("../../../personnalWorkshop");
            }
        }
        else{
            echo "Erreur";
        }

    }


     /**
     * display the pay page for workshop
     * @return void
     */
    public function pay(): void{
       


        $this->loadModel("User");

        $idUser = $this->getUserId();

        $user = $this->_model->getUserInfo($idUser);

        $userEmail = $user['email'];





        $this->loadModel("workshop");

        $params = $_GET['params'];


        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_workshop = $params[0];
        $place = $_POST['place'];

        

        $workshop = $this->_model->getWorkshopById($id_workshop);

        $eventData = array(array(
            "name"=> $workshop['name'],
            "price_purchase"=> $workshop['price'],
            "quantity"=> $place
        ));

        $payment = new StripePayment(STRIPE_API_KEY);

        $payment->startPayment($eventData,$userEmail,$this->activeSecurity("Workshop/paySuccess",array("id_event"=>$id_workshop,"place"=>$place))['url']);

        $page_name = array("Evenement" => "EventsPresentation", "Page de l'évenement" => "EventsPresentation/EventDisplay");

        $this->render('shop/pay', compact('page_name'), DASHBOARD);

    }

}
