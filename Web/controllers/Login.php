<?php 

namespace Controllers;

use App\Mail;
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

        session_start();
        $_SESSION['user'] = $user;

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

            $mail->send($this->_model->getMailById($user['id_users']), 'Votre code de validation Cook Master', $body, $images);


            $this->redirect('resetting/verifymail');
            return;
        }


        $this->redirect('users/profil');

    }

}
