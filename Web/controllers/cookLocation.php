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
        $this->loadModel('cookLocation');
        // $cookLocation = $this->_model->getAllcookLocations();

        $page_name = array("Louer un cuisine" => $this->default_path);
        $this->render('cookLocation/cookLocation', compact('page_name'), DASHBOARD);
    }




}