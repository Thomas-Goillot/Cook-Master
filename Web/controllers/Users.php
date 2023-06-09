<?php

namespace Controllers;

use App\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

class Users extends Controller{


    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "users/profil";


    public function __construct()
    {
        if ($this->isLogged() === false ) {
            $this->redirect('../home');
            exit();
        }
    }

    /**
     * Display the user profil page
     *
     * @return void
     */
    public function profil():void{

        $this->loadModel('User');

        $user = $this->_model->getUserInfo($this->getUserId());


        $cookLocation = $this->_model->getAllCurentLocationById($user["id_users"]);


        $location = $this->_model->getLocationByCurentLocationById($cookLocation['id_location']);

        $subscription = $this->_model->getUserSubscriptionName($this->getUserId());

        $this->loadModel('Shop');

        $allCommands = $this->_model->getAllCommandsValidated($this->getUserId());


       

        $page_name = array("Profil" => $this->default_path);

        $this->render($this->default_path, compact('user', 'subscription', 'page_name', 'allCommands','cookLocation','location'), DASHBOARD);
    }

    /**
     * Download information
     */
    public function downloadInformation():void{

    $this->loadModel('user');
    $data = $this->_model->getUserInfo($this->getUserId());

    $data["subscription"] = $this->_model->getUserSubscriptionName($this->getUserId());

    $html = $this->generateFile('pdf/pdfUser.php', $data);

    $options = new Options();
    
    $options->set('defaultFont', 'Courier');

    $dompdf = new Dompdf($options);

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $fichier = 'informations_profil.pdf';

    $dompdf->stream($fichier);

    }


    /**
     * Display the user editprofil page
     *
     * @return void
     */
    public function editProfil():void{

        $this->loadModel('User');

        $id_users = $this->getUserId();
        
        $user = $this->_model->getUserInfo($id_users);

        $page_name = array("Profil" => $this->default_path,"Modification du profil : ".$user['name'].""=>"../views/users/editProfil/");

        $this->render("users/editProfil", compact('page_name','user','id_users'), DASHBOARD);
    }


    /**
     * Update the user profil
     *
     * @return void
     */
    public function editUserProfil():void{


        $this->loadModel('User');
        $id_users = $this->getUserId();
        $name = htmlspecialchars($_POST['name']);
        $surname = htmlspecialchars($_POST['surname']);

        if(empty($name) || empty($surname)){
            $this->setError("Erreur", "Veuillez remplir tous les champs.", ERROR_ALERT);
            $this->redirect("../users/editProfil");
        }

        if(strlen($name) > MAX_NAME || strlen($surname) > MAX_SURNAME) {
            $this->setError("Erreur", "Veuillez entrer un nom et un prénom valide.", ERROR_ALERT);
            $this->redirect("../users/editProfil");
        }

        $this->_model->editUserInfo($name,$surname,$id_users);

        $this->setError("Modification réussi", "Vos informations on bien été modifié.", SUCCESS_ALERT);
        $this->redirect("../../Users/profil");

    }
/**
     * Update the userContact
     *
     * @return void
     */
    public function editUserContact():void{

        $this->loadModel('User');
        $id_users = $this->getUserId();
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);

        if(empty($email) || empty($phone)){
            $this->setError("Erreur", "Veuillez remplir tous les champs.", ERROR_ALERT);
            $this->redirect("../users/editProfil");
        }

        if(strlen($email) > MAX_EMAIL || strlen($phone) > MAX_PHONE) {
            $this->setError("Erreur", "Veuillez entrer des informations valide.", ERROR_ALERT);
            $this->redirect("../users/editProfil");
        }

        $this->_model->editUserContact($email,$phone,$id_users);

        $this->setError("Modification réussi", "Vos informations on bien été modifié.", SUCCESS_ALERT);
        $this->redirect("../Users/profil");


    }

    /**
     * Update the editUserAddress
     *
     * @return void
     */
    public function editUserAddress():void{

        $this->loadModel('User');
        $id_users = $this->getUserId();
        $address = htmlspecialchars($_POST['address']);
        $city = htmlspecialchars($_POST['city']);
        $zip_code = htmlspecialchars($_POST['zip_code']);
        $country = htmlspecialchars($_POST['country']);

        if(empty($address) || empty($city) || empty($zip_code) || empty($country)){
            $this->setError("Erreur", "Veuillez remplir tous les champs.", ERROR_ALERT);
            $this->redirect("../users/editProfil");
        }

        if(strlen($address) > MAX_ADDRESS || strlen($city) > MAX_CITY || strlen($country) > MAX_COUNTRY) {
            $this->setError("Erreur", "Veuillez entrer des informations valide.", ERROR_ALERT);
            $this->redirect("../users/editProfil");
        }

        $this->_model->editUserAddress($country,$address,$city, $zip_code ,$id_users);

        $this->setError("Modification réussi", "Vos informations on bien été modifié.", SUCCESS_ALERT);
        $this->redirect("../Users/profil");
    }
    /**
     * Update the editUserPassword
     *
     * @return void
     */
    public function editUserPassword():void{

        $this->loadModel('User');
        $id_users = $this->getUserId();
        $password = htmlspecialchars($_POST['password']);
        $password_confirm = htmlspecialchars($_POST['password_confirm']);
        $password_actual = htmlspecialchars($_POST['password_actual']);

    
        if(empty($password) || empty($password_confirm) || empty($password_actual)){
            $this->setError("Erreur", "Veuillez remplir tous les champs.", ERROR_ALERT);
            $this->redirect("../users/editProfil");
        }

        if(strlen($password) < MIN_PASSWORD || strlen($password_confirm) < MIN_PASSWORD) {
            $this->setError("Erreur", "Le mot de passe doit contenir au moin".MAX_PASSWORD." caractère.", ERROR_ALERT);
            $this->redirect("../users/editProfil");
        }

        
        if($password != $password_confirm){
            $this->setError("Erreur", "Les mots de passe ne sont pas identique.", ERROR_ALERT);
            $this->redirect("../users/editProfil");
        }


        $password_actual = $this->hashPassword($password_actual);

        $password = $this->_model->getUserPasswords($id_users);


        if($password_actual != $password){
            $this->setError("Erreur", "Le mot de passe actuel n\'est pas correct.", ERROR_ALERT);
            $this->redirect("../users/editProfil");
        }
        exit;

        $password = $this->hashPassword($password);

        $this->_model->getUserPasswords($password,$id_users);

        $this->setError("Modification réussi", "Vos informations on bien été modifié.", SUCCESS_ALERT);
        $this->redirect("../Users/profil");

    }

}