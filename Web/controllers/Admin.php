<?php

namespace Controllers;

use App\Controller;

class Admin extends Controller
{

    public function __construct()
    {
        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }
    }

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "admin/users";

    /**
     * Display the user profil page
     *
     * @return void
     */
    public function users(): void
    {

        $this->loadModel('User');

        $users = $this->_model->getAll();

        $page_name = "Utilisateurs";

        $this->render($this->default_path, compact('users', 'page_name'), DASHBOARD);
    }
}
