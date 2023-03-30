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

        $this->render('users/profil', compact('profil', 'page_name'), DASHBOARD);
    }

    /**
     * Display the user login page
     *
     * @return void
     */
    public function login():void{
            
        $this->loadModel('User');

        $page_name = "Login";

        $this->render('users/login', compact('page_name'), OTHERS);
    }

    public function checklogin():void{

        $this->loadModel('User');

        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $password = $this->hashPassword($password);

        $user = $this->_model->checklogin($email, $password);

        if($user){
            $_SESSION['user'] = $user;
            header('Location: profil');
        }else{
            header('Location: login');
        }
    }

    /**
     * Display the user register page
     * @return void
     */
    public function register(string $error = ""):void{
            
        $this->loadModel('User');

        $page_name = "Register";

        $this->render('users/register', compact('page_name','error'), OTHERS);
    }

    public function checkregister():void{

        $this->loadModel('User');

        $name = htmlspecialchars($_POST['name']);
        $surname = htmlspecialchars($_POST['surname']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $password = htmlspecialchars($_POST['password']);
        $password = $this->hashPassword($password);

        $user = $this->_model->checkUserExist($email);

        if($user){
            $page_name = "Register error";
            $error = "Une erreur est survenue lors de l'inscription";

            $this->render('users/register', compact('page_name', 'error'), OTHERS);
            return;
        }
        
        $register = $this->_model->register($name, $surname, $email, $phone, $password);

        if(!$register){
            $page_name = "Register error2";
            $error = "Une erreur est survenue lors de l'inscription";

            $this->render('users/register', compact('page_name', 'error'), OTHERS);
            return;
        }

        //header('Location: login');


    }



    /**
     * Display the user forgot password page
     *
     * @return void
     */
    public function forgotPassword():void{
            
        $this->loadModel('User');

        $page_name = "Forgot Password";

        $this->render('users/forgotpassword', compact('page_name'), OTHERS);
    }
    



}