<?php 

namespace Controllers;

use App\Controller;

class login extends Controller{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = 'login/index';

    /**
     * Display the user login page
     *
     * @return void
     */
    public function index(): void
    {

        $page_name = "Login";
        $error = "";

        if(!isset($_POST) || empty($_POST)){
            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }

        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $this->loadModel('User');

        //check that the email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "L'email n'est pas valide";
            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }

        //check that the password is valid
        if (strlen($password) < 3) {
            $error = "Le mot de passe doit contenir au moins 3 caractères";
            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }


        //hash the password
        $password = $this->hashPassword($password);

        //check if the user exist
        $user = $this->_model->checklogin($email, $password);

        if (!$user) {
            $error = "L'email ou le mot de passe est incorrect";
            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }

        session_start();
        $_SESSION['user'] = $user;
        $this->redirect('users/profil');

    }

}
