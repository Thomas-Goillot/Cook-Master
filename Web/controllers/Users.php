<?php

namespace Controllers;

use App\Controller;

class Users extends Controller{


    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "users/profil";


    public function __construct()
    {
        if ($this->isLogged() === false) {
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

        $user = $this->_model->getInfo($_SESSION['user']['id_users']);

        $page_name = "Profil";

        $this->render($this->default_path, compact('user', 'page_name'), DASHBOARD);
    }



   

/*     public function sendmail()
    {

        $mail = new \App\Mail();

        $body = file_get_contents('mails/resetpw.php');

        //add image to mail
        $image_path = LOGO_SVG;
        $image_cid = 'logo';
        $this->mail->addEmbeddedImage($image_path, $image_cid);


        $mail->send('thomadgllt@gmail.com', 'test', $body);

    } */

    



}