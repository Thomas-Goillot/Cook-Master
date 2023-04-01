<?php 

namespace Controllers;

use App\Mail;
use App\Controller;

class Resetting extends Controller{


    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "resetting/password";

    /**
     * Display the user forgot password page
     *
     * @return void
     */
    public function password(): void
    {

        $page_name = "Forgot Password";

        $this->render($this->default_path, compact('page_name'), OTHERS);
    }

    /**
     * Display the user forgot password page
     *
     * @return void
     */
    public function verifymail(): void
    {

        session_start();
        $this->loadModel('User');

        if(!isset($_SESSION['user']['id_users'])){
            $this->redirect('../login');
            return;
        }
        
        if($this->_model->checkMailVerified($_SESSION['user']['id_users'])){
            $this->redirect('../users/profil');
            return;
        }

        $page_name = "Email Validation";
        
        if(isset($_POST) && !empty($_POST)){
            $code = htmlspecialchars($_POST['code_validation']);

            if(!isset($code) || empty($code) && strlen($code) != 8 && $this->_model->checkCode($_SESSION['user']['id_users'], $code)){
                $error = "Le code de validation est incorrect <a href='../resetting/sendverifymail'>Recevoir un nouveau code</a>";
                $this->render("resetting/verifymail", compact('page_name','error'), OTHERS);
                return;
            }

            $this->_model->setMailVerified($_SESSION['user']['id_users']);

            $this->redirect('../users/profil');
        }

        $this->render("resetting/verifymail", compact('page_name'), OTHERS);

    }

    public function sendverifymail(): void
    {
        session_start();

        $page_name = "Email Validation";
        $mail = new Mail();
        $number = $this->generateRandomNumber(8);

        $this->loadModel('User');
        $this->_model->setMailVerified($_SESSION['user']['id_users'], $number);

        $mail->send($this->_model->getMailById($_SESSION['user']['id_users']), "Vérification de votre adresse mail", "Bonjour, Voici votre code de vérification : " . $number . "");

        $this->render("resetting/verifymail", compact('page_name'), OTHERS);
    }


}
