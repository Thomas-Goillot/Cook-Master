<?php

namespace Controllers;

use App\Controller;

class PersonnalEvents extends Controller{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "personnalEvents/index";

    public function __construct()
    {
        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }
    }

    /**
     * Display Event page
     * @return void
     */
    public function index(): void
    {
        $this->loadModel('PersonnalEvents');

        $id = $this->getUserId();

        $events = $this->_model->getAllPersonnalEvents($id);

        $upcomingEvents = $this->_model->getUpcomingPersonnalEvents($id);

        $pastEvents = $this->_model->getPastPersonnalEvents($id);

        foreach ($events as $key => $event) {
            $event['date_start'] = explode(" ", $event['date_start'])[0];
            $event['date_end'] = explode(" ", $event['date_end'])[0];

            $event['date_start'] = explode("-", $event['date_start']);
            $event['date_end'] = explode("-", $event['date_end']);
            //0 = year, 1 = month, 2 = day

            $events[$key]['date_start'] = array();
            $events[$key]['date_end'] = array();
            $events[$key]['date_start']['day'] = $event['date_start'][2];
            $events[$key]['date_start']['month'] = $event['date_start'][1]-1;
            $events[$key]['date_start']['year'] = $event['date_start'][0];

            $events[$key]['date_end']['day'] = $event['date_end'][2];
            $events[$key]['date_end']['month'] = $event['date_end'][1]-1;
            $events[$key]['date_end']['year'] = $event['date_end'][0];

        }

        $page_name = array("PersonnalEvents" => $this->default_path);

        $this->setJsFile(array('events.js'));

        $this->render($this->default_path, compact('events', 'page_name', 'upcomingEvents', 'pastEvents'), DASHBOARD);
    }
}