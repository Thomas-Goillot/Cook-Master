<?php

namespace Controllers;

use App\Controller;

class Home extends Controller{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "home/index";

    public function index(){
        $page_name = array("Accueil" => $this->default_path);

        $this->render($this->default_path, compact('page_name'), NO_LAYOUT);
    }

}