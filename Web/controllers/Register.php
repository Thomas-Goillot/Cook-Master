<?php 

namespace Controllers;

use App\Controller;

class Register extends Controller{


    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "register/index";

    /**
     * Display the user register page
     * @return void
     */
    public function index(string $error = ""): void
    {
        $page_name = array("Register" => $this->default_path);
        $error = "";

        if (!isset($_POST) || empty($_POST)) {
            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }

        //check if every fields are set and not empty
        if (!isset($_POST['name']) || !isset($_POST['surname']) || !isset($_POST['email']) || !isset($_POST['phone']) || !isset($_POST['password']) || !isset($_POST['terms'])) {
            $error = "Tous les champs doivent être remplis";
            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }

        $name = htmlspecialchars($_POST['name']);
        $surname = htmlspecialchars($_POST['surname']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $password = htmlspecialchars($_POST['password']);
        $terms = $_POST['terms'];

        //check that the fields are not empty
        if (empty($name) || empty($surname) || empty($email) || empty($phone) || empty($password) || empty($terms)) {
            $error = "Tous les champs doivent être remplis";
            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }        

        //check that the name is valid
        if(strlen($name) > MAX_NAME){
            $error = "Le nom ne doit pas dépasser". MAX_NAME ." caractères";
            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }

        //check that the surname is valid
        if(strlen($surname) > MAX_SURNAME){
            $error = "Le prénom ne doit pas dépasser". MAX_SURNAME ." caractères";
            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }

        //check that the email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > MAX_EMAIL) {
            $error = "L'email n'est pas valide";
            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }

        //check that the password is valid
        if (strlen($password) < MIN_PASSWORD && strlen($password) > MAX_PASSWORD) {
            $error = "Le mot de passe doit contenir au moins ". MIN_PASSWORD ." caractères et ne doit pas dépasser ". MAX_PASSWORD ." caractères";
            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }

        //check that the phone is valid
        if (strlen($phone) < MIN_PHONE && strlen($phone) > MAX_PHONE) {
            $error = "Le numéro de téléphone doit contenir au moins ". MIN_PHONE ." caractères et ne doit pas dépasser ". MAX_PHONE ." caractères";
            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }

        //check that the terms are checked
        if ($terms != "on") {
            $error = "Vous devez accepter les conditions d'utilisation";
            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }

        //load the model
        $this->loadModel('User');

        //hash the password
        $password = $this->hashPassword($password);

        $register = $this->_model->register($name, $surname, $email, $phone, $password);

        if (!$register) {
            $error = "Une erreur est survenue lors de l'inscription";
            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }

        $this->redirect('login');

    }

}

?>