<?php

namespace Controllers;

use App\Controller;

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
     * Display the add cookLocation page
     * @return void
     */
    public function cookLocation(): void
    {
        $this->loadModel('CookLocation');
        $cookLocation = $this->_model->getAllcookLocation();
        
        $this->loadModel('Location');
        
        foreach ($cookLocation as $location) {
            $getImageLocation = $this->_model->getLocationInfoById($location["id_location"]);
        
            dump($getImageLocation);
            exit;
        }
        
        

        $page_name = array("Louer un cuisine" => $this->default_path);
        $this->render('cookLocation/cookLocation', compact('page_name','cookLocation'), DASHBOARD);
    }

    /**
     * Display the add cookLocationDisplay page
     * @return void
     */
    public function cookLocationDisplay(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_workshop = (int) $params[0];



        $this->loadModel('cookLocation');
        $cookLocation = $this->_model->getAllcookLocation();


        $page_name = array("Location de cuisine"=> $this->default_path, $cookLocation['name'] => "cookLocation/$id_workshop");

        $this->render('cookLocation/cookLocationDisplay', compact('page_name'), DASHBOARD, '../../');
    }




}