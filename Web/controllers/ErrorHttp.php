<?php

namespace Controllers;

use App\Controller;

class ErrorHttp extends Controller{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "error/index";

    private string $pathError = "";

    public function __construct()
    {
        for ($i = 0; $i < substr_count($_GET['p'], "/"); $i++) {
            $this->pathError .= "../";
        } 
    }

    /**
     * Display the error page
     * @return void
     */
    public function error(){
        $error_code = http_response_code();
        
        $page_name = array("Error $error_code" => "");

        $this->render($this->default_path, compact('page_name', 'error_code'), OTHERS, $this->pathError);
    }

}