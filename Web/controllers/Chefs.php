<?php

namespace Controllers;

use App\Controller;

class Chefs extends Controller{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "chefs/index";

    public function index(){

        $this->loadModel('Providers');

        $page_name = array("Chefs" => $this->default_path);

        $getChefImage = $this->_model->getAllChefsImages();

        $this->render($this->default_path, compact('page_name', 'getChefImage'), NO_LAYOUT);

    }



}