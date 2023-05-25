<?php

namespace Controllers;

use App\Controller;

class EventsTemplate extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "admin/eventsTemplate";


    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

        if ($this->isAdmin($this->getUserId()) === false) {
            $this->redirect('../home');
            exit();
        }
    }

    /**
     * Check before add a new event template
     * @return void
     */
    public function addEventTemplate(): void
    {

        $defaultFallBack = "../admin/eventsTemplate";

        if (isset($_POST['EventTemplateName']) && isset($_POST['EventTemplateDescription']) && isset($_POST['EventTemplateEntryPrice']) && isset($_POST['EventTemplatePlace'])) {
            $EventTemplateName = htmlspecialchars($_POST['EventTemplateName']);
            $EventTemplateDescription = htmlspecialchars($_POST['EventTemplateDescription']);
            $EventTemplateEntryPrice = htmlspecialchars($_POST['EventTemplateEntryPrice']);
            $EventTemplatePlace = htmlspecialchars($_POST['EventTemplatePlace']);
            
            if (empty($EventTemplateName)) {
                $this->setError("Echéc de l\'ajout","Le nom du modèle d\'évènement ne doit pas être vide", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (empty($EventTemplateEntryPrice)) {
                $this->setError("Echéc de l\'ajout","Le prix d\'entrée du modèle d\'évènement ne doit pas être vide", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (strlen($EventTemplateName) > NAME_MAX_LENGTH) {
                $this->setError("Echéc de l\'ajout","Le nom du modèle d\'évènement ne doit pas dépasser " . NAME_MAX_LENGTH . " caractères", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (strlen($EventTemplateDescription) > DESCRIPTION_MAX_LENGTH) {
                $this->setError("Echéc de l\'ajout","La description du modèle d\'évènement ne doit pas dépasser " . DESCRIPTION_MAX_LENGTH . " caractères", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if ($EventTemplateEntryPrice < ENTRY_PRICE_MIN) {
                $this->setError("Echéc de l\'ajout","Le prix d\'entrée du modèle d\'évènement ne doit pas être inférieur à " . ENTRY_PRICE_MIN . "€", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if($EventTemplatePlace < MIN_PLACE_EVENT){
                $this->setError("Echéc de l\'ajout","Le nombre de place du modèle d\'évènement ne doit pas être inférieur à " . MIN_PLACE_EVENT, ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }
            
            $this->loadModel('EventsTemplate');

            $res = $this->_model->addEventTemplate($EventTemplateName, $EventTemplateDescription, $EventTemplateEntryPrice, $EventTemplatePlace, $this->getUserId());

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

    /**
     * FOR AJAX REQUEST
     * Get a template event by id and return it in JSON format 
     * @return void
     */
    public function getEventTemplateById(): void
    {
        if (isset($_POST['id_event_template'])) {
            $this->loadModel('EventsTemplate');
            $res = $this->_model->getEventTemplateById($_POST['id_event_template']);
            echo json_encode($res);
        }
    }



}