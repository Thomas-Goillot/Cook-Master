<?php

namespace Controllers;

use App\Mail;
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

        $userId = $this->_model->getUserIdByCourseId($idCourse);

        if($acceptCourse === false){
            $this->setError("Erreur", "Une erreur est survenue lors de l'acceptation de la demande", ERROR_ALERT);
        }

        $mail = new Mail();

        $body = file_get_contents('mails/providerValidate.php');

        $this->loadModel('User');

        $user = $this->_model->getUserInfo($userId);

        $userName = $user['name'];


        $body = str_replace('___name___', $userName, $body);

        $images = [
            'assets/images/logo.png' => 'logo',
            'assets/images/mails/facebook2x.png' => 'facebook',
            'assets/images/mails/instagram2x.png' => 'instagram',
            'assets/images/mails/twitter2x.png' => 'twitter',
            'assets/images/mails/linkedin2x.png' => 'linkedin',
        ];

        
        $mail->send($this->_model->getMailById($user['id_users']), 'Un prestataire a accepté votre demande de cours', $body, $images);

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

        $this->loadModel('User');
        foreach($allCourses as $key => $course){
            $user = $this->_model->getUserInfo($course['id_users']);
            $allCourses[$key]['name'] = $user['name'];
            $allCourses[$key]['surname'] = $user['surname'];
        }

        $this->setJsFile(['providerCourses.js']);

        $page_name = array("Liste des cours" => "providersCourses");

        $this->render("providers/listCourse", compact('page_name', 'allCourses'), DASHBOARD);
    }

    /**
     * Display the page to display info and action of provider on a course
     * @return void
     */
    public function info(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $idCourse = (int) $params[0];

        $this->loadModel('Courses');

        $course = $this->_model->getCourseById($idCourse);

        $this->loadModel('User');

        $user = $this->_model->getUserInfo($course['id_users']);

        $course['name'] = $user['name'];
        $course['surname'] = $user['surname'];
        $course['email'] = $user['email'];
        $course['creation_date'] = $user['creation_date'];


        $page_name = array("Liste des cours" => "CourseService/providersCourses", "Informations sur le cours de " . $course['name'] . " " . $course['surname'] => "CourseService/info/" . $idCourse);

        $this->render("providers/infoCourse", compact('page_name', 'course'), DASHBOARD);
    }
  
}