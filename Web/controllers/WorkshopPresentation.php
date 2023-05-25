<?php

namespace Controllers;

use App\Controller;

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
     * display worshop page
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



        $this->loadModel('workshop');

        $workshop = $this->_model->getWorkshopById($id_workshop);

        $nbPlaceAvailable = $workshop['place'];

            $nbPlaceBooked = $this->_model->getWorkshopBookedPlace($id_workshop);

            if($nbPlaceBooked == NULL){
                $nbPlace = $nbPlaceAvailable;
            }else{
                $nbPlace = $nbPlaceAvailable - $nbPlaceBooked["COUNT(id_join_event)"];
            }



        $page_name = array("Atelier"=> $this->default_path, $workshop['name'] => "workshopDisplay/$id_workshop");

        $this->render('workshop/workshopDisplay', compact('page_name', 'id_workshop','workshop','place'), DASHBOARD, '../../');
    }

}
?>