<?php

namespace Controllers;

use App\Controller;

class Chat extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "chat/index";

    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }
    }

    public function index()
    {
        $page_name = array("Conversation" => "chat");

        $this->render($this->default_path, compact('page_name'),DASHBOARD);
    }




}
?>