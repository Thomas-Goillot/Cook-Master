<?php

namespace Controllers;

use App\Controller;

class Recipes extends Controller{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "recipes/index";

    public function index(){
        $page_name = array("Recipes" => $this->default_path);

        $this->render($this->default_path, compact('page_name'), NO_LAYOUT);
    }

}