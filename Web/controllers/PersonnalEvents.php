<?php

namespace Controllers;

use App\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

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

/*        $id_event = $_GET['id_event'];*/
        
        $events = $this->_model->getAllPersonnalEvents($id);

        $upcomingEvents = $this->_model->getUpcomingPersonnalEvents($id);

        $pastEvents = $this->_model->getPastPersonnalEvents($id);

/*        $upcomingEvent = $this->_model->getUpcomingPersonnalEvent($id, $id_event);*/

/*        $pastEvent = $this->_model->getPastPersonnalEvent($id, $id_event);*/

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

    /**
     * Download all past events informations
     */
    public function downloadPastEventsInformations():void{

        $this->loadModel('PersonnalEvents');

        $data = $this->_model->getPastPersonnalEvents($this->getUserId());
    
        $html = $this->generateFile('pdf/pdfPersonnalPastEvents.php', $data);
    
        $options = new Options();
        
        $options->set('defaultFont', 'Courier');
    
        $dompdf = new Dompdf($options);
    
        $dompdf->loadHtml($html);
    
        $dompdf->setPaper('A4', 'portrait');
    
        $dompdf->render();
    
        $fichier = 'PastEventsInformations.pdf';
    
        $dompdf->stream($fichier);
    
        }

    /**
     * Download all upcoming events informations
     */
    public function downloadUpcomingEventsInformations():void{

        $this->loadModel('PersonnalEvents');
        
        $data = $this->_model->getUpcomingPersonnalEvents($this->getUserId());
    
        $html = $this->generateFile('pdf/pdfPersonnalUpcomingEvents.php', $data);
    
        $options = new Options();
    
        $options->set('defaultFont', 'Courier');
    
        $dompdf = new Dompdf($options);
    
        $dompdf->loadHtml($html);
    
        $dompdf->setPaper('A4', 'portrait');
    
        $dompdf->render();
    
        $fichier = 'UpcomingEventsInformations.pdf';
    
        $dompdf->stream($fichier);
    
        }

    /**
     * Download past event informations
     */
    public function downloadPastEventInformation():void{

        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_event = (int) $params[0];

        $this->loadModel('PersonnalEvents');

        $data = $this->_model->getPastPersonnalEvent($this->getUserId(), $id_event);
    
        $html = $this->generateFile('pdf/pdfPersonnalPastEvent.php', $data);
    
        $options = new Options();
        
        $options->set('defaultFont', 'Courier');
    
        $dompdf = new Dompdf($options);
    
        $dompdf->loadHtml($html);
    
        $dompdf->setPaper('A4', 'portrait');
    
        $dompdf->render();
    
        $fichier = 'PastEventInformation.pdf';
    
        $dompdf->stream($fichier);
    
        }

    /**
     * Download upcoming event informations
     */
    public function downloadUpcomingEventInformation():void{

        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_event = (int) $params[0];

        $this->loadModel('PersonnalEvents');
        
        $data = $this->_model->getUpcomingPersonnalEvent($this->getUserId(), $id_event);
    
        $html = $this->generateFile('pdf/pdfPersonnalUpcomingEvent.php', $data);
    
        $options = new Options();
    
        $options->set('defaultFont', 'Courier');
    
        $dompdf = new Dompdf($options);
    
        $dompdf->loadHtml($html);
    
        $dompdf->setPaper('A4', 'portrait');
    
        $dompdf->render();
    
        $fichier = 'UpcomingEventInformation.pdf';
    
        $dompdf->stream($fichier);
    
        }
}