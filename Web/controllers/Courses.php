<?php

namespace Controllers;

use App\Controller;
use App\StripePayment;

class Courses extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "courses/request";

    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }
    }

    /**
     * Display page my request courses
     * @return void
     */
    public function myRequest():void
    {
        $this->loadModel('Courses');

        $page_name = array("Mes demandes de cours" => $this->default_path);

        $courses = $this->_model->getAllCoursesRequestOfUser($this->getUserId());

        $this->render("courses/myRequest", compact('page_name', 'courses'), DASHBOARD);
    }

    /**
     * Voir les details d'une demande de cours
     * @return void
     */
    public function details():void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../courses/myRequest/');
            exit();
        }

        $idCourse = (int) $params[0];

        $this->loadModel('Courses');

        $course = $this->_model->getCourseById($idCourse);

        if($course === false){
            $this->redirect('../courses/myRequest/');
            exit();
        }

        if($course['statut'] == COURSES_REQUEST){
            $this->redirect('../myRequest/');
            exit();
        }


        $recipes = $this->_model->getAllRecipesOfCourse($idCourse);


        $providerInfo = null;
        $provider = null;
        if(isset($course['id_providers'])){
            $this->loadModel('Providers');

            $provider = $this->_model->getProviderInfo($course['id_providers']);

            $this->loadModel('user');

            $providerInfo = $this->_model->getUserInfo($provider['id_users']);
        }

        $page_name = array("Mes demandes de cours" => $this->default_path, "Détails de la demande" => "courses/details");

        $this->render("courses/details", compact('page_name', 'course', 'recipes', 'providerInfo', 'provider'), DASHBOARD);
    }


    /**
     * Display page request courses
     * @return void
     */
    public function request():void
    {
        $this->loadModel('Recipes');
        $starters = $this->_model->getAllRecipesStarters();
        $dishes = $this->_model->getAllRecipesDishes();
        $desserts = $this->_model->getAllRecipesDesserts();


        $page_name = array("Demande de cours" => $this->default_path);

        $this->setJsFile(['coursesRequest.js']);

        $this->render($this->default_path, compact('page_name', 'starters', 'dishes', 'desserts'), DASHBOARD);
    }

    /**
     * Cancel a course request
     * @return void
     */
    public function cancelRequest():void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../myRequest');
            exit();
        }

        $idCourse = (int) $params[0];

        $this->loadModel('Courses');

        $course = $this->_model->getCourseById($idCourse);

        if($course === false){
            $this->redirect('../myRequest/');
            exit();
        }

        if($course['status'] === COURSES_PAYED){
            $this->setError("Erreur", "Vous ne pouvez pas annuler une demande de cours déjà payée", ERROR_ALERT);
            $this->redirect('../myRequest/');
            exit();
        }

        $this->_model->updateCourseStatus($idCourse, COURSES_ARCHIVED);

        $this->setError("Demande de cours", "Votre demande de cours a été annulée", SUCCESS_ALERT);
        $this->redirect('../myRequest/');
    }

    /**
     * Activate a course request
     * @return void
     */
    public function activate():void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../myRequest');
            exit();
        }

        $idCourse = (int) $params[0];

        $this->loadModel('Courses');

        $course = $this->_model->getCourseById($idCourse);

        if($course === false){
            $this->redirect('../myRequest/');
            exit();
        }
        $this->_model->updateCourseStatus($idCourse, COURSES_PAYED);

        $this->setError("Demande de cours", "Votre demande de cours a été activée", SUCCESS_ALERT);
        $this->redirect('../myRequest/');
    }

    /**
     * Display page validation request
     * @return void
     */
    public function validation():void
    {
        if(!isset($_POST["course-date"]) && empty($_POST["course-date"])){
            $this->setError("Erreur", "Veuillez renseigner une date de cours", ERROR_ALERT);
            $this->redirect('../courses/request');
        }

        if(!isset($_POST["course-time"]) && empty($_POST["course-time"])){
            $this->setError("Erreur", "Veuillez renseigner une heure de cours", ERROR_ALERT);
            $this->redirect('../courses/request');
        }

        $date = htmlspecialchars($_POST["course-date"]);
        $time = htmlspecialchars($_POST["course-time"]);
        $date = $date . " " . $time;
        $date = date("Y-m-d H:i:s", strtotime($date));
        $date = new \DateTime($date);
        $now = new \DateTime();

        if($date < $now){
            $this->setError("Erreur", "Veuillez renseigner une date de cours valide", ERROR_ALERT);
            $this->redirect('../courses/request');
        }

        if(isset($_POST["course-type"]) && $_POST["course-type"] === "on"){
            $course_type = 1; //présentiel
        }else{
            $course_type = 0; //online
        }

        if(isset($_POST["special-request"]) && !empty($_POST["special-request"])){
            $special_request = htmlspecialchars($_POST["special-request"]);
        }

        $this->loadModel('Courses');

        $idCourse = $this->_model->addCoursesRequest($course_type, $special_request, $date, $this->getUserId());


        if(isset($_POST["recipes"]) && !empty($_POST["recipes"])){
            $recipes = array_map('intval', $_POST["recipes"]);

            foreach($recipes as $recipe){

                $this->_model->addCoursesRequestRecipes($recipe, $idCourse);
            }
        }

        if($course_type === 1){
            $address = htmlspecialchars($_POST["address"]);
            $city = htmlspecialchars($_POST["city"]);
            $postal_code = htmlspecialchars($_POST["postal-code"]);
            $country = htmlspecialchars($_POST["country"]);

            $this->_model->addCoursesRequestAddress($address, $city, $postal_code, $country, $idCourse);
        }

        $this->setError("Demande de cours", "Votre demande de cours a été enregistée temporairement. Vous pouvez la retrouver dans la rubrique \"Mes demandes de cours\".", SUCCESS_ALERT);
        $this->redirect('../courses/invoice/'.$idCourse);
    }

    /**
     * Display page récap request / devis
     * @return void
     */
    public function invoice():void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../courses/myRequest/');
            exit();
        }

        $idCourse = (int) $params[0];

        $this->loadModel('Courses');

        $course = $this->_model->getCourseById($idCourse);

        if($course === false){
            $this->redirect('../courses/myRequest/');
            exit();
        }

        $recipes = $this->_model->getAllRecipesOfCourse($idCourse);

        $orderId = $idCourse;

        $allProduct = array(
            "course" => array(
                "name" => "Cours de cuisine",
                "description" => "Cours de cuisine" . ($course['type'] === COURSES_IS_AT_HOME ? " présentiel" : " en ligne"),
                "price_purchase" => $course['type'] === COURSES_IS_AT_HOME ? COURSES_AT_HOME_PRICE : COURSES_ONLINE_PRICE,
                "quantity" => 1,
                "allow_purchase" => 0
            )
        );

        foreach ($recipes as $recipe) {
            $products = array(
                $recipe['id_recipes'] => array(
                    "name" => $recipe['name'],
                    "description" => strlen($recipe['description']) > 25 ? substr($recipe['description'], 0, 25) . "..." : $recipe['description'],
                    "price_purchase" => $recipe['price'],
                    "quantity" => 1,
                    "allow_purchase" => 0
                )
            );

            $allProduct = array_merge($allProduct, $products);
        }

        $sum = 0;
        foreach ($allProduct as $product) {
            $sum += $product['price_purchase'] * $product['quantity'];
        }

        $this->_model->updateCourseTotalPrice($idCourse, $sum);

        //calculate the tva and the price without tva
        $tva = $sum * TVA;
        $priceWithoutTva = $sum - $tva;

        $page_name = array("Demande de cours" => $this->default_path, "Récapitulatif de la demande" => "courses/invoice");

        $pathToPayment = "payment/" . $idCourse;

        $this->render("shop/invoiceRecap", compact('page_name', 'tva', 'priceWithoutTva', 'sum', 'orderId', 'allProduct', 'pathToPayment'), DASHBOARD);
    }

    /**
     * Display page payment
     * @return void
     */
    public function payment():void
    {

        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../courses/myRequest/');
            exit();
        }

        $idCourse = (int) $params[0];

        $this->loadModel('Courses');

        $course = $this->_model->getCourseById($idCourse);

        if($course === false){
            $this->redirect('../courses/myRequest/');
            exit();
        }

        $data = array(array(
            "name" => "Cours de cuisine " . ($course['type'] === COURSES_IS_AT_HOME ? " présentiel" : " en ligne"),
            "price_purchase" => $course['total_price'],
            "id" => $course['id_courses'],
            "quantity" => 1,
            "description" => "Cours de cuisine " . ($course['type'] === COURSES_IS_AT_HOME ? " présentiel" : " en ligne"),
            "allow_purchase" => 0
        ));

        $this->loadModel("User");

        $email = $this->_model->getUserInfo($this->getUserId())['email'];

        $payment = new StripePayment(STRIPE_API_KEY);

        $payment->startPayment($data, $email, $this->activeSecurity("courses/success", array("idCourse" => $idCourse))['url'], $this->activeSecurity("courses/cancel")['url']);
    }

    /**
     * Display page payment success
     * @return void
     */
    public function success():void
    {

        if ($this->checkSecurity()) {

            $page_name = array("Demande de cours" => $this->default_path, "Récapitulatif de la demande" => "courses/invoice", "Paiement" => "courses/payment", "Paiement réussi" => "courses/success");

            $infos = $this->getSecurityParams();

            $this->loadModel('courses');

            $this->_model->updateCourseStatus($infos['idCourse'], COURSES_PAYED);


            $page_name = array("Demande de cours" => $this->default_path, "Récapitulatif de la demande" => "courses/invoice", "Paiement" => "courses/payment", "Paiement réussi" => "courses/success");

            $this->render("courses/successPayment", compact('page_name'), DASHBOARD);

        } else {
            $this->setError("Erreur", "Une erreur est survenue lors du payment", ERROR_ALERT);
            $this->redirect('../UserSubscription/information');
        }

    }

    /**
     * Display page payment cancel
     * @return void
     */
    public function cancel():void
    {
        $this->setError("Erreur", "Le paiement a été annulé", ERROR_ALERT);
        $this->redirect('../courses/myRequest');
    }

    /**
     * Start a online course
     * @return void
     */
    public function onlineCourse():void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../courses/myRequest/');
            exit();
        }

        $idCourse = (int) $params[0];
        $unique = $params[1];

        $this->loadModel('Courses');

        $course = $this->_model->getCourseById($idCourse);

        if ($course === false) {
            $this->setError("Erreur", "Une erreur est survenue lors de la récupération du cours", ERROR_ALERT);
            $this->redirect('../../myRequest/');
            exit();
        }

        if ($course['type'] !== COURSES_IS_ONLINE) {
            $this->setError("Erreur", "Ce cours n\'est pas un cours en ligne", ERROR_ALERT);
            $this->redirect('../../myRequest/');
            exit();
        }

        $course['link'] = substr($course['link'], strrpos($course['link'], "/") + 1);
        if ($unique !== $course['link']) {
            $this->setError("Erreur", "Ce cours n\'est pas disponible", ERROR_ALERT);
            $this->redirect('../../myRequest/');
            exit();
        }

        if ($course['status'] !== COURSES_IS_IN_PROGRESS) {
            $this->setError("Erreur", "Ce n\'est pas le moment de suivre ce cours", ERROR_ALERT);
            $this->redirect('../../myRequest/');
            exit();
        }
        $this->loadModel('User');

        $user = $this->_model->getUserInfo($this->getUserId());



        $page_name = array( "Cours en ligne" => "courses/onlineCourse/" . $idCourse);

        $this->render("courses/onlineCall", compact('page_name', 'course', 'user'), DASHBOARD);
    }





}
?>