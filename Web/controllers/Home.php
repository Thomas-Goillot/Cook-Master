<?php

namespace Controllers;

use App\Controller;

class Home extends Controller{

    public function acceuil(){
        $page_name = "Accueil";

        $this->render('home/acceuil', compact('page_name'));
    }

}