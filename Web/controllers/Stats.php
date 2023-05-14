<?php

namespace Controllers;

use App\Controller;

class Stats extends Controller
{   
    /**
    * Default path to the view
    * @var string
    */
   private string $default_path = "admin/stats";

   
    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

    }

    /**
     * Display the stats page
     * @return void
     */ 
    public function index(): void
    {
        $this->loadModel("Stats");

        $getNumberOfSubscriptionsByDate = $this->_model->getNumberOfSubscriptionsByDate();

        $getCountSubscriptions = $this->_model->getCountSubscriptions();
        
        $page_name = array("Les statistiques" => "admin/stats"); 

        $this->setJsFile(['stats.js']);

        $this->render('admin/stats', compact('page_name','getNumberOfSubscriptionsByDate', 'getCountSubscriptions'), DASHBOARD);
    }

   
}
