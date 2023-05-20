<?php

namespace Controllers;

use App\Controller;

class SkillsAdmin extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "SkillsAdmin/certificate";


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
     * Display page certificate
     * @return void
     */
    public function certificate(): void
    {
        $this->loadModel('SkillsAdmin');
        $certificates = $this->_model->getAllCertificates();
        $allSkills = $this->_model->getAllSkills();

        $page_name = array("Admin" => $this->default_path, "Certificats" => $this->default_path);

        $this->render($this->default_path, compact('page_name', 'certificates', 'allSkills'), DASHBOARD);
    }

    public function addcertificate(): void
    { 
        $defaultFallBack = "../SkillsAdmin/certificate";
        if (!isset($_POST['name']) && !isset($_POST['description']) && !isset($_POST['Skills'])) {
            $this->setError('Erreur', 'Veuillez remplir tous les champs', ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        if(empty($_POST['name']) || empty($_POST['description']) || empty($_POST['Skills'])){
            $this->setError('Erreur', 'Veuillez remplir tous les champs', ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);

        if(strlen($_POST['name']) > 100 || strlen($_POST['description']) > 1000){
            $this->setError('Erreur', 'Le nom ne doit pas dépasser 100 caractères et la description 1000 caractères', ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        $nbSkills = count($_POST['Skills']);

        if($nbSkills < 1){
            $this->setError('Erreur', 'Veuillez sélectionner au moins une compétence', ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        $this->loadModel('SkillsAdmin');

        $idCertificate = $this->_model->addCertificate($name, $description);

        foreach($_POST['Skills'] as $skill){
            $this->_model->addCertificateSkill($idCertificate,(int) $skill);
        }

        $this->setError('Succès', 'Le certificat a bien été ajouté', SUCCESS_ALERT);
        $this->redirect($defaultFallBack);
    
    }

    /**
     * Display page skills
     * @return void
     */
    public function skills(): void
    {
        $this->loadModel('SkillsAdmin');
        $skills = $this->_model->getAllSkills();

        $page_name = array("Admin" => $this->default_path, "Compétences" => $this->default_path);

        $this->render('SkillsAdmin/skills', compact('page_name', 'skills'), DASHBOARD);
    }

    /**
     * Add a skill
     * @return void
     */
    public function addSkill(): void
    {

        $defaultFallBack = "../SkillsAdmin/skills";
        if (!isset($_POST['name']) && !isset($_POST['description'])) {

            $this->setError('Erreur', 'Veuillez remplir tous les champs', ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        if(empty($_POST['name']) || empty($_POST['description'])){
            $this->setError('Erreur', 'Veuillez remplir tous les champs', ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);

        if(strlen($_POST['name']) > 100 || strlen($_POST['description']) > 1000){
            $this->setError('Erreur', 'Le nom ne doit pas dépasser 100 caractères et la description 1000 caractères', ERROR_ALERT);
            $this->redirect($defaultFallBack);
        }

        $this->loadModel('SkillsAdmin');

        if($this->_model->addSkill($name, $description)){
            $this->setError('Succès', 'La compétence a bien été ajoutée', SUCCESS_ALERT);
            $this->redirect($defaultFallBack);
        }

    }




}