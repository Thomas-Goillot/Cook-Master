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

        // dump($cookLocations);
        // exit();



        


        $page_name = array("Location de cuisine"=> $this->default_path);

        $this->render('cookLocation/cookLocationDisplay', compact('page_name','cookLocations'), DASHBOARD, '../../');
    }




}