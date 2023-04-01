<?php

namespace Controllers;

use App\Controller;

class ErrorHttp extends Controller{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "error/index";

    public function error(){
        $error_code = http_response_code();
        
        $page_name = "Error $error_code";

        $this->render($this->default_path, compact('page_name', 'error_code'), OTHERS);
    }

}