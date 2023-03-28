<?php

namespace Controllers;

use App\Controller;

class Main extends Controller{

    public function index(){
        $this->render('main/index', ['title' => 'Accueil']);
    }

}