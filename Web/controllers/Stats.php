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

        $dataOfStarters = $this->_model->CountStarters();

        $dataOfStarters_1 = $dataOfStarters[0];

        $dataOfDishes = $this->_model->CountDishes();

        $dataOfDishes_1 = $dataOfDishes[0];

        $dataOfDesserts = $this->_model->CountDesserts();

        $dataOfDesserts_1 = $dataOfDesserts[0];

        $page_name = array("Les statistiques" => "admin/stats"); 

        $this->setJsFile(['stats.js']);

        $this->render('admin/stats', compact('page_name','getNumberOfSubscriptionsByDate', 'getCountSubscriptions','dataOfStarters_1','dataOfDishes_1','dataOfDesserts_1'), DASHBOARD);
    }
   
}
