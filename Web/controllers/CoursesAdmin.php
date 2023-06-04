<?php

namespace Controllers;

use App\Mail;
use App\Controller;

class CoursesAdmin extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "CoursesAdmin/index";

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
     * Display the list of courses page
     * @return void
     */
    public function index(): void
    {

        $this->loadModel('Courses');

        $allCourses = $this->_model->getAllCourses();

        $page_name = array("Listes des cours" => "CoursesAdmin");

        $this->render($this->default_path, compact('page_name', 'allCourses'), DASHBOARD);
    }


}
