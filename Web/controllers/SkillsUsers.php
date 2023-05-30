<?php

namespace Controllers;

use App\Controller;

class SkillsUsers extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "skillsAdmin/certificate";


    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }
    }

    /**
     * Display the user skills page
     */
    public function increase(): void
    {
        //$this->setJsFile(['dotCheckProgressBar.js']);
        $this->setCssFile(['css/certificate/dotCheckProgressBar.css']);

        $page_name = array("Skills & Progress" => "../SkillsUsers/increase");
        $this->loadModel('SkillsUsers');

        $certificates = array();

        $idCertificates = $this->_model->getIdCertificatesUserIsWorkingOnByIdUser($this->getUserId());

        foreach ($idCertificates as $idCertificate) {
            $certificates[] = $this->_model->getCertificateInfo($idCertificate['id_certificate']);
        }
        
        $validatedSkills = $this->_model->getSkillsValidatedByUser($this->getUserId());
        
        $certificates = array_unique($certificates, SORT_REGULAR);

        foreach($validatedSkills as $key => $validatedSkill) {
            $validatedSkills[$key]['id_certificate'] = $this->_model->getIdCertificateByIdSkills($validatedSkill['id_skills']);
        }


        $this->render('skills/increase', compact('page_name', 'certificates', 'validatedSkills'), DASHBOARD);
    }




}