<?php

namespace Controllers;

use App\Controller;

class Events extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "events";


    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

        $this->loadModel('User');

        $id_access = $this->_model->getAll();

        $id_access = (int)$id_access[0]['id_access'];

        if ($this->isAdmin($id_access) === false) {
            $this->redirect('../home');
            exit();
        }
    }

    /**
     * Check before add a new event
     * @return void
     */
    public function addEvent(): void
    {   
        $defaultFallBack = "../admin/events";

        if (isset($_POST['EventName']) && isset($_POST['EventDescription']) && isset($_POST['EventEntryPrice']) || isset($_POST['EventDate']) || isset($_POST['EventTemplateId']) || isset($_POST['EventPlace'])) {
            $EventName = htmlspecialchars($_POST['EventName']);
            $EventDescription = htmlspecialchars($_POST['EventDescription']);
            $EventEntryPrice = htmlspecialchars($_POST['EventEntryPrice']);
            $EventDate = htmlspecialchars($_POST['EventDate']);
            $EventTemplateId = htmlspecialchars($_POST['EventTemplateId']);
            $Eventplace = htmlspecialchars($_POST['EventPlace']);

            if (empty($EventName) || empty($EventDescription) || empty($EventEntryPrice) || empty($EventDate) || empty($EventTemplateId) || empty($Eventplace)) {
                $this->setError("Echéc de l\'ajout","Veuillez remplir tous les champs", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (strlen($EventName) > NAME_MAX_LENGTH) {
                $this->setError("Echéc de l\'ajout","Le nom de l\'évènement ne doit pas dépasser " . NAME_MAX_LENGTH . " caractères", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (strlen($EventDescription) > DESCRIPTION_MAX_LENGTH) {
                $this->setError("Echéc de l\'ajout","La description de l\'évènement ne doit pas dépasser " . DESCRIPTION_MAX_LENGTH . " caractères", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if ($EventEntryPrice < ENTRY_PRICE_MIN) {
                $this->setError("Echéc de l\'ajout","Le prix d\'entrée de l\'évènement ne doit pas être inférieur à " . ENTRY_PRICE_MIN . "€", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            $EventDate = explode('-', $EventDate);
            $EventDate['start'] = $EventDate[0];
            $EventDate['end'] = $EventDate[1];

            $EventDate['start'] = str_replace('/', '-', $EventDate['start']);
            $EventDate['end'] = str_replace('/', '-', $EventDate['end']);

            if (strtotime($EventDate['start']) < strtotime(date('Y-m-d'))) {
                $this->setError("Echéc de l\'ajout","La date de début de l\'évènement ne doit pas être dans le passé", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (strtotime($EventDate['end']) < strtotime(date('Y-m-d'))) {
                $this->setError("Echéc de l\'ajout","La date de fin de l\'évènement ne doit pas être dans le passé", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (strtotime($EventDate['end']) < strtotime($EventDate['start'])) {
                $this->setError("Echéc de l\'ajout","La date de fin de l\'évènement ne doit pas être avant la date de début", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if($Eventplace < MIN_PLACE_EVENT) {
                $this->setError("Echéc de l\'ajout","Le nombre de place de l\'évènement ne doit pas être inférieur à " . MIN_PLACE_EVENT, ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            $this->loadModel('Events');

            $EventDate['start'] = date('Y-m-d', strtotime($EventDate['start']));
            $EventDate['end'] = date('Y-m-d', strtotime($EventDate['end']));

            $userId = $this->getUserId();

            $res = $this->_model->addEvent($EventName, $EventDescription, $EventEntryPrice, $userId, $EventDate['start'], $EventDate['end'], $Eventplace);

            if ($res === false) {
                $this->setError("Echéc de l\'ajout", "Une erreur est survenue lors de l\'ajout de l\'évènement", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            $this->setError("Création de l\'événement avec succés", "L\'évènement a bien été ajouté", SUCCESS_ALERT);
            $this->redirect($defaultFallBack);
            exit();

        } 

        $this->setError("Echéc de l\'ajout", "Une erreur est survenue lors de l\'ajout de l\'évènement", ERROR_ALERT);
        $this->redirect($defaultFallBack);
        exit();      
    }

    /**
     * Check before edit an event
     * @return void
     */
    public function editEvent(): void
    {
        $defaultFallBack = "../admin/events";

        if (isset($_POST['EventName']) && isset($_POST['EventDescription']) && isset($_POST['EventEntryPrice']) || isset($_POST['EventDate']) || isset($_POST['EventId']) || isset($_POST['EventPlace'])) {
            $EventName = htmlspecialchars($_POST['EventName']);
            $EventDescription = htmlspecialchars($_POST['EventDescription']);
            $EventEntryPrice = htmlspecialchars($_POST['EventEntryPrice']);
            $EventDate = htmlspecialchars($_POST['EventDate']);
            $EventId = htmlspecialchars($_POST['EventId']);
            $EventPlace = htmlspecialchars($_POST['EventPlace']);

            if (empty($EventName) || empty($EventDescription) || empty($EventEntryPrice) || empty($EventDate) || empty($EventId) || empty($EventPlace)) {
                $this->setError("Echéc de la modification", "Veuillez remplir tous les champs", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (strlen($EventName) > NAME_MAX_LENGTH) {
                $this->setError("Echéc de la modification", "Le nom de l\'évènement ne doit pas dépasser " . NAME_MAX_LENGTH . " caractères", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (strlen($EventDescription) > DESCRIPTION_MAX_LENGTH) {
                $this->setError("Echéc de la modification", "La description de l\'évènement ne doit pas dépasser " . DESCRIPTION_MAX_LENGTH . " caractères", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if ($EventEntryPrice < ENTRY_PRICE_MIN) {
                $this->setError("Echéc de la modification", "Le prix d\'entrée de l\'évènement ne doit pas être inférieur à " . ENTRY_PRICE_MIN . "€", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            $EventDate = explode('-', $EventDate);
            $EventDate['start'] = $EventDate[0];
            $EventDate['end'] = $EventDate[1];

            $EventDate['start'] = str_replace('/', '-', $EventDate['start']);
            $EventDate['end'] = str_replace('/', '-', $EventDate['end']);

            if (strtotime($EventDate['start']) < strtotime(date('Y-m-d'))) {
                $this->setError("Echéc de la modification", "La date de début de l\'évènement ne doit pas être dans le passé", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (strtotime($EventDate['end']) < strtotime(date('Y-m-d'))) {
                $this->setError("Echéc de la modification", "La date de fin de l\'évènement ne doit pas être dans le passé", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if (strtotime($EventDate['end']) < strtotime($EventDate['start'])) {
                $this->setError("Echéc de la modification", "La date de fin de l\'évènement ne doit pas être avant la date de début", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            if($EventPlace < MIN_PLACE_EVENT){
                $this->setError("Echéc de la modification", "Le nombre de place doit être supérieur à " . MIN_PLACE_EVENT, ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }


            $this->loadModel('Events');

            $EventDate['start'] = date('Y-m-d', strtotime($EventDate['start']));
            $EventDate['end'] = date('Y-m-d', strtotime($EventDate['end']));

            $userId = $this->getUserId();

            $res = $this->_model->updateEvent($EventId , $EventName, $EventDescription, $EventEntryPrice, $userId, $EventDate['start'], $EventDate['end'], $EventPlace);

            if ($res === false) {
                $this->setError("Echéc de la modification", "Une erreur est survenue lors de la modification de l\'évènement", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            $this->setError("Modification de l\'événement avec succés", "L\'évènement a bien été modifié", SUCCESS_ALERT);
            $this->redirect($defaultFallBack);
            exit();
        }

        $this->setError("Echéc de la modification", "Une erreur est survenue lors de la modification de l\'évènement", ERROR_ALERT);
        $this->redirect($defaultFallBack);
        exit();
    }

    /**
     * Check before delete an event
     * @return void
     */

    public function deleteEvent(): void
    {
        $defaultFallBack = "../admin/events";

        if (isset($_POST['EventId'])) {
            $EventId = htmlspecialchars($_POST['EventId']);

            if (empty($EventId)) {
                $this->setError("Echéc de la suppression", "Une erreur est survenue lors de la suppression de l\'évènement", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            $this->loadModel('Events');


            $res = $this->_model->deleteProviderEvent($EventId);

            if ($res === false) {
                $this->setError("Echéc de la suppression", "Une erreur est survenue lors de la suppression de l\'évènement", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }


            $res = $this->_model->deleteParticipantEvent($EventId);

            if ($res === false) {
                $this->setError("Echéc de la suppression", "Une erreur est survenue lors de la suppression de l\'évènement", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            $res = $this->_model->deleteEvent($EventId);

            if ($res === false) {
                $this->setError("Echéc de la suppression", "Une erreur est survenue lors de la suppression de l\'évènement", ERROR_ALERT);
                $this->redirect($defaultFallBack);
                exit();
            }

            $this->setError("Suppression de l\'événement avec succés", "L\'évènement a bien été supprimé", SUCCESS_ALERT);
            $this->redirect($defaultFallBack);
            exit();
        }

        $this->setError("Echéc de la suppression", "Une erreur est survenue lors de la suppression de l\'évènement", ERROR_ALERT);
        $this->redirect($defaultFallBack);
        exit();
    }
    


}

?>