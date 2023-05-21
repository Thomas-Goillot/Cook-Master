<?php

namespace Controllers;

use App\Controller;

class CourseService extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "providers/coursRegistrationService"; 
   
    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

        if($this->isProvider($this->getUserId()) === false || $this->isAdmin($this->getUserId()) === false){
            $this->redirect('../home');
            exit();
        }
    }
    
    /**
     * Display the Home service page
     * @return void
     */ 
    public function index(): void
    {

        $this->loadModel('Courses');

        $allCoursesRequest = $this->_model->getAllCoursesRequest();


        $page_name = array("Inscription aux cours utilisateur" => "CourseService");

        $this->render($this->default_path, compact('page_name', 'allCoursesRequest'), DASHBOARD);
    }

    /**
     * Accept a course request
     * @return void
     */
    public function acceptCourse(): void
    {
        if(!isset($_POST['idCourse']) && empty($_POST['idCourse'])){
            $this->setError("Erreur", "Une erreur est survenue lors de l'acceptation de la demande", ERROR_ALERT);
        }

        $idCourse = (int) htmlspecialchars($_POST['idCourse']);

        $this->loadModel('Providers');

        $idProvider = $this->_model->getProviderInfoByUserId($this->getUserId())['id_providers'];

        $this->loadModel('Courses');

        $acceptCourse = $this->_model->addProviderToCourses($idCourse, $idProvider);

        if($acceptCourse === false){
            $this->setError("Erreur", "Une erreur est survenue lors de l'acceptation de la demande", ERROR_ALERT);
        }

        $this->setError("Succès", "La demande a bien été acceptée", SUCCESS_ALERT);
        $this->redirect('../CourseService/providersCourses');
    }

    /**
     * List of course of a provider
     * @return void
     */
    public function providersCourses(): void
    {

        $this->loadModel('Providers');

        $idProvider = $this->_model->getProviderInfoByUserId($this->getUserId())['id_providers'];

        $this->loadModel('Courses');

        $allCourses = $this->_model->getAllCoursesByProvider($idProvider);

        $page_name = array("Liste des cours" => "providersCourses");

        $this->render("providers/listCourse", compact('page_name', 'allCourses'), DASHBOARD);
    }
  
}