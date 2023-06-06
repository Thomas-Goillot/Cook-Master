<?php

namespace Controllers;

use App\Controller;

class Sponsor extends Controller{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "sponsor";

    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }
    }

    /**
     * Display the sponsor page
     * @return void
     */
    public function index()
    {
        $this->loadModel('Sponsor');

        $sponsorLink = $this->_model->getSponsorLink($this->getUserId());
        $expirationDate = $this->_model->getSponsorLinkExpirationDate($this->getUserId());

        $sponsorLink = $this->getDomainName() . "sponsor/receive/" . $sponsorLink . "/" . $this->getUserId();

        if (isset($sponsorLink) && $sponsorLink != null) {
            $qrCode = $this->generateQrCode($sponsorLink);
        }

        echo date('Y-m-d');

        $page_name = array("Parainage" => "sponsor");

        $this->render("sponsor/index", compact('page_name', 'sponsorLink', 'qrCode', 'expirationDate'), DASHBOARD);
    }

    /**
     * Generate a link for the sponsor
     * @return void
     */
    public function generateLink()
    {
        $userId = $this->getUserId();

        $link = $this->generateRandomString(50);
        $expirationDate = date('Y-m-d', strtotime('+3 days'));

        $this->loadModel('Sponsor');

        if ($this->_model->addLink($link, $expirationDate, $userId)) {
            $this->setError("C\'est Good!", "Votre lien de parrainage a été généré avec succès Vous avez 3 jours pour le partager avec vos amis avant qu\'il n\'expire", SUCCESS_ALERT);
            $this->redirect('../sponsor');
        } else {
            $this->setError("Oops!", "Une erreur est survenue lors de la génération de votre lien de parrainage", ERROR_ALERT);
            $this->redirect('../sponsor');
        }
    }


    /**
     * Receive the sponsor link
     * @return void
     */
    public function receive(){

        $params = $_GET['params'];

        if (count($params) === 0) {            
            $this->redirect('../home');
        }

        $pass = $params[0];
        $idUserSponsor = (int) htmlspecialchars($params[1]);
        $idUserSponsored = $this->getUserId();

        $this->loadModel('Sponsor');
        $expirationDate = $this->_model->getSponsorLinkExpirationDate($idUserSponsor);

        if ($idUserSponsor == $idUserSponsored) {
            $this->setError("Oops!", "Vous ne pouvez pas vous parrainer vous-même", ERROR_ALERT);
            $this->redirect('../../users/profil');
        }

        if($this->_model->checkLink($pass, $idUserSponsor) == false){
            $this->setError("Oops!", "Le lien de parrainage est invalide", ERROR_ALERT);
            $this->redirect('../../../users/profil');
        }

        if($expirationDate < date('Y-m-d')){
            $this->setError("Oops!", "Le lien de parrainage a expiré", ERROR_ALERT);
            $this->redirect('../../../users/profil');
        }

        if(!$this->_model->incrementSponsorCounter($idUserSponsor)){
            $this->setError("Oops!", "Une erreur est survenue lors de l\'ajout de votre parrain", ERROR_ALERT);
            $this->redirect('../../../users/profil');
        }

        $this->setError("C\'est Good!", "Vous avez été parrainé avec succès", SUCCESS_ALERT);
        $this->redirect('../../../users/profil');


    }


}