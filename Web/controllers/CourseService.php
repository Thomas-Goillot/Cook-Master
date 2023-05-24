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

        $userId = $this->_model->getUserIdByCourseId($idCourse);

        if($userId === $this->getUserId()){
            $this->setError("Erreur", "Vous ne pouvez pas accepter votre propre demande", ERROR_ALERT);
            $this->redirect('../CourseService');
        }

        $acceptCourse = $this->_model->addProviderToCourses($idCourse, $idProvider);


        if($acceptCourse === false){
            $this->setError("Erreur", "Une erreur est survenue lors de l'acceptation de la demande", ERROR_ALERT);
            $this->redirect('../CourseService');
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

    /**
     * Start a course
     * @return void
     */
    public function startCourse(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $idCourse = (int) $params[0];

        $this->loadModel('Courses');

        $userId = $this->_model->getUserIdByCourseId($idCourse);

        $this->_model->updateCourseStatus($idCourse, COURSES_IS_IN_PROGRESS);
        
        $courseInfo = $this->_model->getCourseById($idCourse);

        $idUserProvider = $this->_model->getUserIdbyProviderId($courseInfo['id_providers']);


        if($courseInfo['type'] === COURSES_IS_ONLINE){
            $uniqueId = uniqid();
            $this->_model->addlinkToCourses($idCourse, $this->getDomainName() . "Courses/onlineCourse/" . $idCourse. "/" . $uniqueId);
        }

        $mail = new Mail();

        $body = file_get_contents('mails/providerStartCourse.php');

        $this->loadModel('User');

        $user = $this->_model->getUserInfo($userId);
        $ProviderInfo = $this->_model->getUserInfo($idUserProvider);

        $userName = $user['name'];

        $body = str_replace('___name___', $userName, $body);

        $body = str_replace('___provider___', $ProviderInfo['name']. " ". $ProviderInfo['surname'] , $body);

        $images = [
            'assets/images/logo.png' => 'logo',
            'assets/images/mails/facebook2x.png' => 'facebook',
            'assets/images/mails/instagram2x.png' => 'instagram',
            'assets/images/mails/twitter2x.png' => 'twitter',
            'assets/images/mails/linkedin2x.png' => 'linkedin',
        ];

        $mail->send($this->_model->getMailById($user['id_users']), 'Le cours va bientôt commencer', $body, $images);

        $this->setError("Succès", "Le cours a bien été démarré", SUCCESS_ALERT);
        $this->redirect('../info/' . $idCourse);
    }

    /**
     * End a course
     * @return void
     */
    public function endCourse(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $idCourse = (int) $params[0];

        $this->loadModel('Courses');

        $userId = $this->_model->getUserIdByCourseId($idCourse);

        $this->_model->updateCourseStatus($idCourse, COURSES_IS_DONE);
        
        $courseInfo = $this->_model->getCourseById($idCourse);

        $this->setError("Succès", "Le cours a bien été terminé", SUCCESS_ALERT);
        $this->redirect('../info/' . $idCourse);
    }

    /**
     * Validate Skills of a user after a course
     * @return void
     */
    public function ValidateSkills(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $idCourse = (int) $params[0];

        $this->loadModel('Courses');

        $userId = $this->_model->getUserIdByCourseId($idCourse);

        $this->_model->updateCourseStatus($idCourse, COURSES_IS_DONE);
        
        $courseInfo = $this->_model->getCourseById($idCourse);

        $this->loadModel('SkillsAdmin');

        $allSkills = $this->_model->getAllSkills();

        $this->loadModel('User');

        $user = $this->_model->getUserInfo($courseInfo['id_users']);


        $page_name = array("Liste des cours" => "CourseService/providersCourses", "Validation des compétences de " . $user['name'] . " " . $user['surname'] => "CourseService/ValidateSkills/" . $idCourse);

        $this->render("providers/validateSkills", compact('page_name', 'allSkills', 'userId', 'idCourse'), DASHBOARD);
    }

    /**
     * Handle the validation of skills
     * @return void
     */
    public function handleSkills(): void
    {

        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $idCourse = (int) $params[0];

        if(!isset($_POST['skills']) && empty($_POST['skills'])){
            $this->setError("Erreur", "Une erreur est survenue lors de la validation des compétences", ERROR_ALERT);
            $this->redirect('../providersCourses');
        }

        if(isset($_POST['commentary']) && !empty($_POST['commentary'])){
            $commentary = htmlspecialchars($_POST['commentary']);
        }else{
            $commentary = "";
        }

        $skills = $_POST['skills'];

        $this->loadModel('Courses');
        $userId = $this->_model->getUserIdByCourseId($idCourse);

        $this->loadModel('SkillsAdmin');

        foreach($skills as $skill){
            $this->_model->addSkillToUser($userId, $skill);
        }

        $this->loadModel('Courses');

        $this->_model->updateCourseStatus($idCourse, COURSES_ARCHIVED);  
        $this->_model->addCommentaryToCourse($idCourse, $commentary);

        $mail = new Mail();

        $body = file_get_contents('mails/providerEndCourse.php');

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

        $mail->send($this->_model->getMailById($user['id_users']), 'Merci ! Le cours est terminé', $body, $images);

        $this->setError("Succès", "Les compétences ont bien été validées", SUCCESS_ALERT);
        $this->redirect('../info/' . $idCourse);      

    }
  
    /**
     * Cancel a course
     * @return void
     */
    public function cancelCourse(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $idCourse = (int) $params[0];

        $this->loadModel('Courses');

        $userId = $this->_model->getUserIdByCourseId($idCourse);

        
        $courseInfo = $this->_model->getCourseById($idCourse);
        
        $idUserProvider = $this->_model->getUserIdbyProviderId($courseInfo['id_providers']);
        
        $this->_model->removeProviderFromCourse($idCourse);

        $mail = new Mail();

        $body = file_get_contents('mails/providerCancelCourse.php');

        $this->loadModel('User');

        $user = $this->_model->getUserInfo($userId);
        $ProviderInfo = $this->_model->getUserInfo($idUserProvider);

        $userName = $user['name'];

        $body = str_replace('___name___', $userName, $body);

        $body = str_replace('___provider___', $ProviderInfo['name']. " ". $ProviderInfo['surname'] , $body);

        $body = str_replace('___date___', $this->convertDateFrench(explode(" ",$courseInfo['date_of_courses'])[0]) , $body);

        $body = str_replace('___hour___', explode(" ",$courseInfo['date_of_courses'])[1] , $body);


        $images = [
            'assets/images/logo.png' => 'logo',
            'assets/images/mails/facebook2x.png' => 'facebook',
            'assets/images/mails/instagram2x.png' => 'instagram',
            'assets/images/mails/twitter2x.png' => 'twitter',
            'assets/images/mails/linkedin2x.png' => 'linkedin',
        ];

        $mail->send($this->_model->getMailById($user['id_users']), 'Désolé... Le cours a été annulé', $body, $images);

        $this->setError("Succès", "Le cours a bien été annulé", SUCCESS_ALERT);
        $this->redirect('../providersCourses');
    }

    /**
     * Create a chat room for a course
     * @return void
     */
    public function createChat(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $idCourse = (int) $params[0];

        $this->loadModel('Courses');

        $courseInfo = $this->_model->getCourseById($idCourse);

        $idUserProvider = $this->_model->getUserIdbyProviderId($courseInfo['id_providers']);

        $this->loadModel('Tchat');

        if($this->_model->checkConversation($courseInfo['id_users'], $idUserProvider) === true){
            $this->setError("Erreur", "Une conversation existe déjà pour ces deux utilisateurs", ERROR_ALERT);
            $this->redirect('../info/' . $idCourse);
        }

        $this->_model->createConversation($courseInfo['id_users'], $idUserProvider);

        $this->setError("Succès", "La conversation a bien été créée", SUCCESS_ALERT);
        $this->redirect('../info/' . $idCourse);
    }
    


}