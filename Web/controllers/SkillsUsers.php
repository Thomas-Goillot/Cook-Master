<?php

namespace Controllers;

use App\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

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

        $page_name = array("Compétences" => "../SkillsUsers/increase");
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

        foreach ($certificates as $key => $certificate) {
            $certificates[$key]['skills'] = $certificate['skills'];
            $certificates[$key]['isComplete'] = true;

            foreach ($certificates[$key]['skills'] as $skill) {
                $isComplete = false;
                foreach ($validatedSkills as $validatedSkill) {
                    if ($validatedSkill['id_skills'] == $skill['id_skills'] && in_array($certificate['id_certificate'], $validatedSkill['id_certificate'])) {
                        $isComplete = true;
                        break;
                    }
                }
                if ($isComplete === false) {
                    $certificates[$key]['isComplete'] = false;
                    break;
                }
            }
        }
        $this->render('skills/increase', compact('page_name', 'certificates', 'validatedSkills'), DASHBOARD);
    }


    /**
     * Download all past events informations
     */
    public function download(): void
    {

        $params = $_GET['params'];

        if (count($params) === 0) {
            $this->redirect('../SkillsUsers/increase');
        }

        $idCertificat = $params[0];

        $this->loadModel('user');

        $data = $this->_model->getUserInfo($this->getUserId());

        $this->loadModel('SkillsUsers');

        $dataCertificate = $this->_model->getCertificateInfo($idCertificat);

        $data['certificate'] = array_merge($data, $dataCertificate);

        $html = $this->generateFile('pdf/pdfCertificate.php', $data);

        $options = new Options();

        $options->set('defaultFont', 'Courier');

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $fichier = 'Certificat_' . str_replace(' ', '_', $data['certificate']['name']) . '_' . ucfirst($data['name']) . '_' . ucfirst($data['surname']) . '.pdf';

        $dompdf->stream($fichier);
    }




}