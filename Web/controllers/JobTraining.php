<?php

namespace Controllers;

use App\Controller;
use App\StripePayment;

class JobTraining extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "jobTraining/index";

    public function __construct()
    {
        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }
    }

    /**
     * Display the list of all training
     * @return void
     */
    public function index(): void
    {

        $this->loadModel("Training");

        $trainings = $this->_model->getTraining();

        $page_name = array("Admin" => $this->default_path, "Training" => "training");
        $this->render($this->default_path, compact('page_name', 'trainings'), DASHBOARD);
    }

    /**
     * Display the training info
     * @return void
     */
    public function show(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_training = (int) $params[0];

        $this->loadModel("Training");

        $training = $this->_model->getTrainingById($id_training);

        $userIsInTraining = $this->_model->userIsInTraining($this->getUserId(), $id_training);


        $page_name = array("Admin" => $this->default_path, "Training" => "training", "Show" => "show");
        $this->render("jobTraining/show", compact('page_name', 'training', 'userIsInTraining'), DASHBOARD);
    }

    /**
     * Join a training
     * @return void
     */
    public function join(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_training = (int) $params[0];

        $this->loadModel("Training");

        $training = $this->_model->getTrainingById($id_training);

        $data = array(array(
            "name" => $training['name'],
            "price_purchase" => $training['price'],
            "id" => $training['id_job_training'],
            "quantity" => 1,
            "description" => "Achat de la formation " . $training['name'],
            "allow_purchase" => 0
        ));

        $this->loadModel("User");

        $email = $this->_model->getUserInfo($this->getUserId())['email'];

        $payment = new StripePayment(STRIPE_API_KEY);

        $payment->startPayment($data, $email, $this->activeSecurity("jobTraining/success", array("id_job_training" => $training['id_job_training']))['url'], $this->activeSecurity("jobTraining/cancel")['url']);
    }

    /**
     * Success page after payment
     * @return void
     */
    public function success(): void
    {
        if ($this->checkSecurity()) {

            $infos = $this->getSecurityParams();

            $this->loadModel("Training");

            if($this->_model->addUserToTraining($this->getUserId(), $infos['id_job_training'])){
                $this->setError("Succès", "Vous avez bien été inscrit à la formation", SUCCESS_ALERT);
                $this->redirect('../jobTraining/index');
            }
            else{
                $this->setError("Erreur", "Une erreur est survenue lors de l'inscription", ERROR_ALERT);
                $this->redirect('../jobTraining/index');
            }
        } else {
            $this->setError("Erreur", "Une erreur est survenue lors du payment", ERROR_ALERT);
            $this->redirect('../jobTraining/index');
        }
    }

    /**
     * Cancel page after payment
     * @return void
     */
    public function cancel(): void
    {
        $this->setError("Erreur", "Vous avez annulé le payment", ERROR_ALERT);
        $this->redirect('../jobTraining/index');
    }

}
