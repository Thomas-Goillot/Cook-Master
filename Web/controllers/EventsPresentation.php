<?php

namespace Controllers;

use App\Controller;

class EventsPresentation extends Controller
{
    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "EventsPresentation/index";
   
    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

    }
    /**
     * Display the EventsPresentation page
     * @return void
     */ 
    public function index(): void
    {

        $this->loadModel("EventsPresentation");

        $page_name = array("Evènements" => "eventsPresentation/index");

        $getAllEvents = $this->_model->getAllEvents();
        
        $this->render('events/index', compact('page_name', 'getAllEvents'), DASHBOARD);

    }

    /**
     * display Event page
     * @return void
     */
    public function EventDisplay(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_event = (int) $params[0];

        $this->loadModel('EventsPresentation');

        $event = $this->_model->getEventById($id_event);

        $page_name = array("Evènements"=> $this->default_path, $event['name'] => "EventDisplay/$id_event");

        $this->render('events/event', compact('page_name', 'id_event', 'event'), DASHBOARD, '../../');
    }
}