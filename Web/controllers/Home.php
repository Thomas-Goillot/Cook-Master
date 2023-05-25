<?php

namespace Controllers;

use App\Controller;

class Home extends Controller{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "home/index";

    /**
     * Display the home page
     * @return void
     */
    public function index(){

        $isLogged = $this->isLogged();

        $page_name = array("Accueil" => $this->default_path);

        $this->render($this->default_path, compact('page_name', 'isLogged'), NO_LAYOUT);
    }

}