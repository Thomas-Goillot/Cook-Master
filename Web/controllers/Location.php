<?php

namespace Controllers;

use App\Controller;

class Location extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "Location/index";

    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

        $this->loadModel('User');

        $id_access = $this->_model->getAll();

        $id_access = (int)$id_access[0]['id_access'];

        if ($this->isAdmin($id_access) === false) {
            $this->redirect('../home');
            exit();
        }
    }

    public function index()
    {

        $page_name = array("Admin" => $this->default_path, "Emplacement" => $this->default_path, "Liste des Lieux" => $this->default_path);

        $this->render($this->default_path, compact('page_name'), DASHBOARD,'../');
    }

}
