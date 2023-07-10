<?php

namespace Controllers;

use App\Controller;
use App\StripePayment;

class TrainingService extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "trainingService/index";

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

        $trainings = $this->_model->getTrainingOfProvider($this->getUserId());

        $page_name = array("Admin" => $this->default_path, "Training" => "training");
        $this->render($this->default_path, compact('page_name', 'trainings'), DASHBOARD);
    }

    /**
     * Display the training page
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
        $listeUsers = $this->_model->getUsersByTraining($id_training);

        $page_name = array("Préstataire" => $this->default_path, "Formation" => "trainingService", $training['name'] => "trainingService/show/"."$id_training");
        $this->render('trainingService/show', compact('page_name', 'training', 'listeUsers'), DASHBOARD);
    }

    /**
     * Display the workshop page
     * @return void
     */
    public function workshop(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_workshop = (int) $params[0];
        $id_training = (int) $params[1];

        $this->loadModel("Workshop");

        $workshop = $this->_model->getWorkshopById($id_workshop);
        $equipments = $this->_model->getAllUseEquipmentWorkshopById($id_workshop);
        $recipes = $this->_model->getRecipesByWorkshop($id_workshop);

        $this->loadModel("Training");
        $listeUsers = $this->_model->getUsersByTraining($id_training);

        $page_name = array("Préstataire" => $this->default_path, "Formation" => "trainingService/show/"."$id_training", "Atelier" => "trainingService/workshop/"."$id_workshop/"."$id_training");

        $this->render('trainingService/workshop', compact('page_name', 'workshop', 'equipments', 'recipes', 'listeUsers'), DASHBOARD);
    }


    

}
