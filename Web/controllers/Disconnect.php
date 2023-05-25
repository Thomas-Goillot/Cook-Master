<?php

namespace Controllers;

use App\Controller;

class Disconnect extends Controller
{

    public function __construct()
    {
        if(!$this->isLogged()){
            $this->redirect('home');
            exit();
        }
    }

    /**
     * Disconnect the user
     * @return void
     */
    public function index()
    {
        $_SESSION = [];
        session_destroy();
        $this->redirect('home');
    }
}
