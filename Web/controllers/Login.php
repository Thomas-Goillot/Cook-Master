<?php 

namespace Controllers;

use App\Mail;
use App\Controller;
use App\Utils;

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

        $page_name = array("Login" => $this->default_path);
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
        if (strlen($password) < MIN_PASSWORD) {
            $error = "Le mot de passe doit contenir au moins ". MIN_PASSWORD ." caractères";
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

        //check if the user is banned
        if ($this->_model->checkIsBanUserByMail($email)) {
            $error = "Vous avez été banni";
            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }

        session_start();
        $_SESSION['user'] = $user;


        $userIp = $_SERVER['REMOTE_ADDR'];
        $this->loadModel('UserSecurity');
        if ($this->_model->firstConnection($user['id_users']) === true) {
            $idUserIp = $this->_model->addIp($user['id_users'], $userIp, IP_ALLOWED);
        }

        if ($this->checkUserIp($user['id_users'], $_SERVER['REMOTE_ADDR']) === false) {
            $error = "Vous vous êtes connecté depuis une adresse IP différente de la dernière fois, veuillez vérifier votre boite mail";

            $mail = new Mail();

            $body = file_get_contents('mails/ipchange.php');

            $userName = $user['name'];

            $this->loadModel('UserSecurity');
            if($this->_model->checkIp($user['id_users'], $userIp) === false){
                $idUserIp = $this->_model->addIp($user['id_users'], $userIp, IP_NOT_ALLOWED);
            }
            else{
                $idUserIp = $this->_model->getIpId($user['id_users'], $userIp);
            }

            $body = str_replace('___name___', $userName, $body);

            $body = str_replace('___ip___', $userIp, $body);

            $body = str_replace('___validationLink___', $this->getDomainName() . 'login/validate/'. Utils::crypt($idUserIp), $body);

            $images = [
                'assets/images/logo.png' => 'logo',
                'assets/images/mails/___passwordreset.gif' => 'passwordreset',
                'assets/images/mails/facebook2x.png' => 'facebook',
                'assets/images/mails/instagram2x.png' => 'instagram',
                'assets/images/mails/twitter2x.png' => 'twitter',
                'assets/images/mails/linkedin2x.png' => 'linkedin',
            ];

            $this->loadModel('User');
            $mail->send($this->_model->getMailById($user['id_users']), 'Connexion depuis une adresse IP différente', $body, $images);

            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }

        if($this->checkAllowIp($user['id_users'], $_SERVER['REMOTE_ADDR']) === false){
            $error = "Votre adresse IP n'est pas autorisée à se connecter à ce compte";

            $mail = new Mail();

            $body = file_get_contents('mails/notAllowedIp.php');

            $userName = $user['name'];
            $userIp = $_SERVER['REMOTE_ADDR'];

            $this->loadModel('UserSecurity');

            $body = str_replace('___name___', $userName, $body);

            $body = str_replace('___ip___', $userIp, $body);

            $images = [
                'assets/images/logo.png' => 'logo',
                'assets/images/mails/___passwordreset.gif' => 'passwordreset',
                'assets/images/mails/facebook2x.png' => 'facebook',
                'assets/images/mails/instagram2x.png' => 'instagram',
                'assets/images/mails/twitter2x.png' => 'twitter',
                'assets/images/mails/linkedin2x.png' => 'linkedin',
            ];
            $this->loadModel('User');
            $mail->send($this->_model->getMailById($user['id_users']), 'Connexion à votre compte depuis une adresse IP non autorisée', $body, $images);


            unset($_SESSION['user']);
            $this->render($this->default_path, compact('page_name', 'error'), OTHERS);
            return;
        }

        $this->loadModel('User');
        if($this->_model->checkMailVerified($user['id_users']) == false){
            $mail = new Mail();
            $number = $this->generateRandomNumber(8);
            $this->_model->setValidationCode($user['id_users'], $number);

            $body = file_get_contents('mails/mailvalidation.php');

            $body = str_replace('___validationCode___', $number, $body);


            $images = [
                'assets/images/logo.png' => 'logo',
                'assets/images/mails/___passwordreset.gif' => 'passwordreset',
                'assets/images/mails/facebook2x.png' => 'facebook',
                'assets/images/mails/instagram2x.png' => 'instagram',
                'assets/images/mails/twitter2x.png' => 'twitter',
                'assets/images/mails/linkedin2x.png' => 'linkedin',
            ];

            $this->loadModel('User');
            $mail->send($this->_model->getMailById($user['id_users']), 'Votre code de validation Cook Master', $body, $images);


            $this->redirect('resetting/verifymail');
            return;
        }


        $this->redirect('users/profil');

    }


    public function validate():void
    {
        if(!isset($_GET['params']) || empty($_GET['params'])){
            $this->redirect('../Home');
            return;
        }

        $params = $_GET['params'];

        if(count($params) === 0){
            $this->redirect('../Home');
            return;
        }

        $idIp = Utils::decrypt($params[0]);

        if(!is_numeric($idIp)){
            $this->redirect('../Home');
            return;
        }

        $this->loadModel('UserSecurity');

        $this->_model->updateAllowedIp($idIp);

        $this->setError("Ip validée", "Votre adresse IP a été validée", SUCCESS_ALERT);
        $this->redirect('../../users/profil'); 

    }


}
