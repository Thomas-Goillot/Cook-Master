<?php

namespace Controllers;

use App\Controller;

class Avatar extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "Avatar";

    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }
    }

    public function createAvatar()
    {

        $this->loadModel('Avatar');

        $id = $this->getUserId();

        $userAsAvatar = $this->_model->CheckIfUserGetAvatar($id);


        $avatar = array();
        if ($userAsAvatar != false) {
            $avatar = $this->_model->getAvatar($id);
        }
        else{
            $avatar['head'] = $this->randomImg('assets/images/avatar/head/');
            $avatar['eyes'] = $this->randomImg('assets/images/avatar/eyes/');
            $avatar['nose'] = $this->randomImg('assets/images/avatar/nose/');
            $avatar['mouth'] = $this->randomImg('assets/images/avatar/mouth/');
            $avatar['brows'] = $this->randomImg('assets/images/avatar/brows/');
        }

        $avatar = $this->generateFile('views/avatar/avatarImages.php', compact('avatar'));


        $page_name = array("Avatar" => "avatar", "Création d'un avatar" => "avatar/createAvatar");

        $this->setJsFile(array('avatar.js'));

        $this->render('avatar/createAvatar', compact('avatar','page_name'),DASHBOARD);
    }

    public function random():void
    {
        $avatar = array();

        $avatar['head'] = $this->randomImg('assets/images/avatar/head/');
        $avatar['eyes'] = $this->randomImg('assets/images/avatar/eyes/');
        $avatar['nose'] = $this->randomImg('assets/images/avatar/nose/');
        $avatar['mouth'] = $this->randomImg('assets/images/avatar/mouth/');
        $avatar['brows'] = $this->randomImg('assets/images/avatar/brows/');

        $html = $this->generateFile('views/avatar/avatarImages.php',compact('avatar'));

        echo $html;
    }

    public function saveAvatar(): void
    {
        $this->loadModel('Avatar');

        $id = $this->getUserId();

        $userAsAvatar = $this->_model->CheckIfUserGetAvatar($id);

        $_POST = json_decode(file_get_contents('php://input'), true);

        if (!empty($_POST['head']) && !empty($_POST['eyes']) && !empty($_POST['nose']) && !empty($_POST['mouth']) && !empty($_POST['brows'])) {
            $tempHead = explode('/', $_POST['head']);
            $tempEyes = explode('/', $_POST['eyes']);
            $tempNose = explode('/', $_POST['nose']);
            $tempMouth = explode('/', $_POST['mouth']);
            $tempBrows = explode('/', $_POST['brows']);
            
            $head = end($tempHead);
            $eyes = end($tempEyes);
            $nose = end($tempNose);
            $mouth = end($tempMouth);
            $brows = end($tempBrows);

        } else {
            echo json_encode(array(
                'title' => 'Petit malin !',
                'message' => 'Merci de ne pas modifier le code source de la page !',
                'type' => 'warning',
            ));
            exit;
        }

    

        if ($userAsAvatar != false) {
            $res = $this->_model->updateAvatar($id, $head, $eyes, $nose, $mouth, $brows);
        } else {
            $res = $this->_model->createAvatar($id, $head, $eyes, $nose, $mouth, $brows);
        }

        if ($res) {
            echo json_encode(array(
                'title' => 'Avatar enregistré !',
                'message' => 'Votre avatar a bien été enregistré !',
                'type' => 'success',
            ));
            exit;
        } else {
            echo json_encode(array(
                'title' => 'Erreur !',
                'message' => 'Une erreur est survenue lors de l\'enregistrement de votre avatar !',
                'type' => 'error',
            ));
            exit;
        }
    }


}