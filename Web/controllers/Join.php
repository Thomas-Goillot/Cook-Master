<?php

namespace Controllers;

use App\Controller;

class Join extends Controller{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "join/index";

    /**
     * Display the index page
     * @return void
     */
    public function index(){

        $page_name = array("Join" => $this->default_path);

        $this->render($this->default_path, compact('page_name'), NO_LAYOUT);
    }

}