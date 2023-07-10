<?php

namespace Controllers;

use App\Controller;

class Training extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "training/index";

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
     * Display the list of all training
     * @return void
     */
    public function index(): void
    {

        $this->loadModel("Training");

        $trainings = $this->_model->getTraining();

        $page_name = array("Admin" => $this->default_path, "Training" => "training");
        $this->render('training/index', compact('page_name', 'trainings'), DASHBOARD);
    }

    /**
     * Display the form to create a new training
     * @return void
     */
    public function create(): void
    {
        $this->loadModel("Providers");
        $providers = $this->_model->getProviders();

        $this->loadModel("Workshop");
        $workshops = $this->_model->getAllWorkshop();


        $page_name = array("Admin" => $this->default_path, "Training" => "training", "Create" => "training/create");
        $this->render('training/create', compact('page_name', 'providers', 'workshops'), DASHBOARD);
    }

    /**
     * Save a new training
     * @return void
     */
    public function save(): void
    {
        $this->loadModel("Training");

        if (isset($_POST['name']) === false || empty($_POST['name']) === true) {
            $this->setError("Erreur !", "Le titre est obligatoire", ERROR_ALERT);
            $this->redirect('../training/create');
            exit();
        }

        if (isset($_POST['price']) === false || empty($_POST['price']) === true) {
            $this->setError("Erreur !", "Le prix est obligatoire", ERROR_ALERT);
            $this->redirect('../training/create');
            exit();
        }

        if (isset($_POST['workshop']) === false || empty($_POST['workshop']) === true) {
            $this->setError("Erreur !", "L'atelier est obligatoire", ERROR_ALERT);
            $this->redirect('../training/create');
            exit();
        }

        if (isset($_POST['providers']) === false || empty($_POST['providers']) === true) {
            $this->setError("Erreur !", "Le prestataire est obligatoire", ERROR_ALERT);
            $this->redirect('../training/create');
            exit();
        }
        
        if (is_numeric($_POST['price']) === false) {
            $this->setError("Erreur !", "Le prix doit être un nombre", ERROR_ALERT);
            $this->redirect('../training/create');
            exit();
        }

        if ($_POST['price'] < 0) {
            $this->setError("Erreur !", "Le prix doit être positif", ERROR_ALERT);
            $this->redirect('../training/create');
            exit();
        }

        $name = $_POST['name'];
        $price = $_POST['price'];
        $workshop = $_POST['workshop'];
        $providers = $_POST['providers'];

        $this->_model->saveTraining($name, $price, $workshop, $providers);

        $this->setError("C\'est good !", "La formation a bien été enregistré", SUCCESS_ALERT);
        $this->redirect('../training');
    }

    /**
     * Display the form to edit a training
     * @return void
     */
    public function edit(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_training = (int) $params[0];

        $this->loadModel("Training");
        $training = $this->_model->getTrainingById($id_training);

        $this->loadModel("Providers");
        $providers = $this->_model->getProviders();

        $this->loadModel("Workshop");
        $workshops = $this->_model->getAllWorkshop();

        $page_name = array("Admin" => $this->default_path, "Training" => "training", "Edit" => "training/edit");
        $this->render('training/edit', compact('page_name', 'training', 'providers', 'workshops'), DASHBOARD);
    }

    /**
     * Save the modification of a training
     * @return void
     */
    public function editSave(): void
    {
        $this->loadModel("Training");

        if (isset($_POST['name']) === false || empty($_POST['name']) === true) {
            $this->setError("Erreur !", "Le titre est obligatoire", ERROR_ALERT);
            $this->redirect('../training/create');
            exit();
        }

        if (isset($_POST['price']) === false || empty($_POST['price']) === true) {
            $this->setError("Erreur !", "Le prix est obligatoire", ERROR_ALERT);
            $this->redirect('../training/create');
            exit();
        }

        if (isset($_POST['workshop']) === false || empty($_POST['workshop']) === true) {
            $this->setError("Erreur !", "L'atelier est obligatoire", ERROR_ALERT);
            $this->redirect('../training/create');
            exit();
        }

        if (isset($_POST['providers']) === false || empty($_POST['providers']) === true) {
            $this->setError("Erreur !", "Le prestataire est obligatoire", ERROR_ALERT);
            $this->redirect('../training/create');
            exit();
        }

        if (is_numeric($_POST['price']) === false) {
            $this->setError("Erreur !", "Le prix doit être un nombre", ERROR_ALERT);
            $this->redirect('../training/create');
            exit();
        }

        if ($_POST['price'] < 0) {
            $this->setError("Erreur !", "Le prix doit être positif", ERROR_ALERT);
            $this->redirect('../training/create');
            exit();
        }

        $id_training = $_POST['id_training'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $workshop = $_POST['workshop'];
        $providers = $_POST['providers'];

        $this->_model->saveTrainingEdit($id_training, $name, $price, $workshop, $providers);

        $this->setError("C\'est good !","La formation a bien été modifiée", SUCCESS_ALERT);
        $this->redirect('../training');
    }

    /**
     * Delete a training
     * @return void
     */
    public function delete(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_training = (int) $params[0];

        $this->loadModel("Training");
        $this->_model->deleteTraining($id_training);

        $this->setError("C\'est good !","La formation a bien été supprimée", SUCCESS_ALERT);
        $this->redirect('../../training');
    }



}
