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
     * Check before add a new event template
     * @return void
     */
    public function addJoin(): void
    {

        $defaultFallBack = "../join";

        if (isset($_POST['siret']) && isset($_POST['cv']) && isset($_POST['photo'])) {

            $Siret = htmlspecialchars($_POST['siret']);
            $Cv = htmlspecialchars($_POST['cv']);
            $Photo = htmlspecialchars($_POST['photo']);
            
            if (empty($Siret)) {
                $this->setError("Echéc de l\'ajout","Le siret ne doit pas être vide", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (empty($Cv)) {
                $this->setError("Echéc de l\'ajout","Le CV doit être renseigné", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (empty($Photo)) {
                $this->setError("Echéc de l\'ajout","La photo doit être renseignée", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }
            
            $this->loadModel('Join');

            $res = $this->_model->addJoin($Siret, $Cv, $Photo, $this->getUserId());

            if($res === true){
                $this->setError("Succès","Le modèle d\'évènement a bien été ajouté", SUCCESS_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }else{
                $this->setError("Echéc de l\'ajout","Une erreur est survenue lors de l\'ajout du modèle d\'évènement", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }
        }
    }
}