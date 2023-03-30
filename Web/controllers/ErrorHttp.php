<?php

namespace Controllers;

use App\Controller;

class ErrorHttp extends Controller{

    public function error(){
        $error_code = http_response_code();
        
        $page_name = "Error $error_code";

        $this->render('error/error', compact('page_name', 'error_code'), OTHERS);
    }

}