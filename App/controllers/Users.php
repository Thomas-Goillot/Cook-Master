<?php
namespace Controllers;

use App\Controller;

class Users extends Controller{

    /**
     * Display the user profil page
     *
     * @return void
     */
    public function profil():void{

        $this->loadModel('User');

        $profil = $this->_model->getAll();

        $page_name = "Profil";

        $this->render('users/profil', compact('profil', 'page_name'));
    }

    /**
     * Display the user login page
     *
     * @return void
     */
    public function login():void{
            
        $this->loadModel('User');

        $page_name = "Login";

        $this->render('users/login', compact('page_name'));
    }
    

    /**
     * Display the user register page
     *
     * @return void
     */

    public function register():void{
            
        $this->loadModel('User');

        $page_name = "Register";

        $this->render('users/register', compact('page_name'));
    }

}