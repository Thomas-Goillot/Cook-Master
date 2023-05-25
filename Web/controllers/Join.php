<?php

namespace Controllers;

use App\Controller;

class Join extends Controller
{
   
    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

    }
    
    /**
     * Display the join page
     * @return void
     */ 
    public function index(): void
    {
        $this->loadModel("Join");
        
        $page_name = array("Nous rejoindre" => "join/index");

        $this->render('join/index', compact('page_name'), DASHBOARD);
    }

    /**
     * Check before send request in the database
     * @return void
     */
    public function sendRequest(): void
    {

        if (!isset($_POST['submit'])) {
            $defaultFallBack = '../join';

            $acceptable = array('image/jpeg', 'image/png', 'application/pdf');
            $cv = $_FILES['cv']['type'];
            $photo = $_FILES['photo']['type'];

            if (!in_array($cv, $acceptable)) {
                $this->setError('Type de fichier non autorisée', "Les type de fichier autorisé sont :  .png, .jpeg et .pdf", ERROR_ALERT);
                $this->redirect($defaultFallBack);
            }

            if (!in_array($photo, $acceptable)) {
                $this->setError('Type de fichier non autorisée', "Les type de fichier autorisé sont :  .png, .jpeg et .pdf", ERROR_ALERT);
                $this->redirect($defaultFallBack);
            }

            $maxSize = 5 * 1024 * 1024; //5 Mo
            if ($_FILES['cv']['size'] > $maxSize) {
                $this->setError('Fichier trop lourd', "la taille du fichier ne doit pas dépasser 5 Mo", ERROR_ALERT);
                $this->redirect($defaultFallBack);
            }

            $maxSize = 5 * 1024 * 1024; //5 Mo
            if ($_FILES['photo']['size'] > $maxSize) {
                $this->setError('Fichier trop lourd', "la taille du fichier ne doit pas dépasser 5 Mo", ERROR_ALERT);
                $this->redirect($defaultFallBack);
            }

            $path = 'assets/images/request/cv';
            if (!file_exists('assets/images/request/cv')) {
                mkdir('assets/images/request/cv');
            }

            $filename = $_FILES['cv']['name'];

            $array = explode('.', $filename);
            $extension = end($array);

            $filename = 'image-' . time() . '.' . $extension;

            $destination = $path . '/' . $filename;

            move_uploaded_file($_FILES['cv']['tmp_name'], $destination);

            $cv = $filename;


            $path = 'assets/images/request/pictures';
            if (!file_exists('assets/images/request/pictures')) {
                mkdir('assets/images/request/pictures');
            }

            $filename = $_FILES['photo']['name'];

            $array = explode('.', $filename);
            $extension = end($array);

            $filename = 'image-' . time() . '.' . $extension;

            $destination = $path . '/' . $filename;

            move_uploaded_file($_FILES['photo']['tmp_name'], $destination);

            $photo = $filename;


            $siret = htmlspecialchars($_POST['siret']);
            $type = htmlspecialchars($_POST['customRadio']);
            $id_users = $this->getUserId();

            if (empty($siret)) {
                $this->setError("Echéc de l\'envoie de demande","Le siret ne doit pas être vide", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (empty($type)) {
                $this->setError("Echéc de l\'envoie de demande","Selectionnez un poste", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (strlen($siret) != 14) {
                $this->setError("Echéc de l\'envoie de demande","Renseignez un siret valide", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            $this->loadModel("Join");

            $siretNumber = $this->_model->checksiret($siret);
            
            if ($siretNumber[0]["COUNT(*)"] == 1) {
                $this->setError("Echéc de l\'envoie de demande","Siret déjà utilisé", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }else{
                $this->_model->sendRequest($siret, $id_users, $cv, $photo, $type);
            }
            
        }
        $this->setError("Demande envoyée !", "Votre demande a été envoyée avec succès", SUCCESS_ALERT);
        $this->redirect($defaultFallBack);
    }
   
}