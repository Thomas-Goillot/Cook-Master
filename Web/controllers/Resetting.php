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

        $page_name = array("Forgot Password" => $this->default_path);

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

        $page_name = array("Email Validation" => "");
        
        if(isset($_POST) && !empty($_POST)){
            $code = htmlspecialchars($_POST['code_validation']);

            if(!$this->_model->checkCode($_SESSION['user']['id_users'], $code)){
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

        $page_name = array("Email Validation" => "");
        $mail = new Mail();
        $number = $this->generateRandomNumber(8);

        $this->loadModel('User');
/*         $this->_model->setMailVerified($_SESSION['user']['id_users'], $number);

        $body = file_get_contents('mails/resetpw.php');
        $body = str_replace('___validationCode___', $number, $body);

        $images = [
            'assets/images/logo.png' => 'logo',
            'assets/images/mails/___passwordreset.gif' => 'passwordreset',
            'assets/images/mails/facebook2x.png' => 'facebook',
            'assets/images/mails/instagram2x.png' => 'instagram',
            'assets/images/mails/twitter2x.png' => 'twitter',
            'assets/images/mails/linkedin2x.png' => 'linkedin',
        ];

        $mail->send($this->_model->getMailById($user['id_users']), 'Votre code de validation Cook Master', $body, $images); */

        $this->redirect('../resetting/verifymail');
    }


}
