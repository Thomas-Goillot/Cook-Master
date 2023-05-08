<?php

namespace Controllers;

use App\Controller;

//DEFINIR LE NOM DE LA CLASSE = NOM DU FICHIER = NOM DU CONTROLLER
class NomController extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    // CETTE VARIABLE EST UTILISEE DANS LE RENDER POUR DEFINIR LE CHEMIN VERS LA VUE PAR DEFAUT DU CONTROLLER 
    private string $default_path = "users/profil"; 

    // CONSTRUCTEUR DU CONTROLLER QUI VERIFIE SI L'UTILISATEUR EST CONNECTE SINON REDIRIGE VERS LA PAGE D'ACCUEIL
    // IL N'EST PAS POSSIBLE D'UTILISER LES DEUX TYPES DE CONSTRUCTEURS EN MEME TEMPS 
    // IL EST POSSIBLE DE CHANGER LE CHEMIN VERS LA PAGE D'ACCUEIL EN MODIFIANT LE PARAMETRE DE LA FONCTION redirect()
    public function __construct()
    {
        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }
    }

    // AUTRE TYPE DE CONSTRUCTEUR QUI VERIFIE SI L'UTILISATEUR EST CONNECTE ET SI IL EST ADMIN SINON REDIRIGE VERS LA PAGE D'ACCUEIL
    // IL N'EST PAS POSSIBLE D'UTILISER LES DEUX TYPES DE CONSTRUCTEURS EN MEME TEMPS 
    // IL EST POSSIBLE DE CHANGER LE CHEMIN VERS LA PAGE D'ACCUEIL EN MODIFIANT LE PARAMETRE DE LA FONCTION redirect()
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

    /**
     * Display the user profil page
     *
     * @return void
     */
    // METHODE = FONCTION = CORRESPONDS A UNE PAGE OU UNE ACTION 
    public function profil(): void
    {

        // RECUPERER LES PARAMETRES DE L'URL APRES LE NOM DU CONTROLLER ET DE LA METHODE 
        // EXEMPLE : http://localhost/NomController/profil/1/2/3
        // ICI LES PARAMETRES SONT 1, 2 ET 3
        // LES PARAMETRES SONT STOCKES DANS UN TABLEAU
        // EXEMPLE : ICI LE TABLEAU $params CONTIENT LES PARAMETRES 1, 2 ET 3
        // ON VERIFIE SI LE TABLEAU $params CONTIENT DES PARAMETRES ET SI LE PREMIER PARAMETRE EST UN NOMBRE
        // SI LE TABLEAU $params NE CONTIENT PAS DE PARAMETRES OU SI LE PREMIER PARAMETRE N'EST PAS UN NOMBRE ON REDIRIGE L'UTILISATEUR VERS LA PAGE D'ACCUEIL
        $params = $_GET['params'];
        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }
        // ON RECUPERE LE PREMIER PARAMETRE DU TABLEAU $params ET ON LE CONVERTIT EN NOMBRE
        $id_event = (int) $params[0];

        // PERMET DE CHARGER UN MODEL POUR POUVOIR UTILISER LES FONCTIONS DU MODEL DANS LE CONTROLLER (UNIQUEMENT DES FONCTIONS DE RECUPERATION DE DONNEES)
        $this->loadModel('User');

        // EXEMPLE D'UTILISATION D'UNE FONCTION DU MODEL
        $user = $this->_model->getUserInfo($_SESSION['user']['id_users']);

        // PAGE NAME EST UN TABLEAU QUI PERMET DE DEFINIR LE NOM DE LA PAGE ET LES SOUS PAGES DANS LE MENU DE NAVIGATION 
        // LE NOM DE LA PAGE EST LE DERNIERE ELEMENT DU TABLEAU 
        // LES SOUS PAGES SONT DEFINIES PAR LES CLES DU TABLEAU ET LES VALEURS SONT LES CHEMINS VERS LES SOUS PAGES
        // EXEMPLE : ICI LE NOM DE LA PAGE EST "Profil" ET LA SOUS PAGE EST "users/profil" (CHEMIN VERS LA VUE PAR DEFAUT DU CONTROLLER)
        $page_name = array("Profil" => $this->default_path);

        // PERMET DE DEFINIR LES FICHIERS CSS A UTILISER POUR LA PAGE
        // LE CHEMIN VERS LES FICHIERS CSS COMMENCE DANS LE DOSSIER "assets"
        // EXEMPLE : ICI LE CHEMIN VERS LE FICHIER CSS EST "assets/css/home/styles.css"
        $this->setCssFile(['css/home/styles.css']);

        // PERMET DE DEFINIR LES FICHIERS JS A UTILISER POUR LA PAGE
        // LE CHEMIN VERS LES FICHIERS JS COMMENCE DANS LE DOSSIER "assets/pages"
        // EXEMPLE : ICI LE CHEMIN VERS LE FICHIER JS EST "assets/pages/script.js"
        $this->setJsFile(['script.js']);

        // PERMET D'AFFICHER UNE ERREUR A L'UTILISATEUR LORS DE LA REDIRECTION VERS UNE PAGE
        // LE PREMIER PARAMETRE EST LE NOM DE L'ERREUR
        // LE DEUXIEME PARAMETRE EST LE MESSAGE A AFFICHER
        // LE TROISIEME PARAMETRE EST LE TYPE D'ERREUR (SUCCESS_ALERT / ERROR_ALERT / WARNING_ALERT / INFO_ALERT)
        $this->setError('Fichier trop lourd', "la taille du fichier ne doit pas dépasser 5 Mo", ERROR_ALERT);

        // PERMET DE REDIRIGER L'UTILISATEUR VERS UNE PAGE
        // LE PARAMETRE EST LE CHEMIN VERS LA PAGE (nom du controller / nom de la methode)
        $this->redirect('../home');
        // IL EST POSSIBLE DE REDIRIGER L'UTILISATEUR VERS UNE PAGE AVEC DES PARAMETRES
        // LE PARAMETRE EST LE CHEMIN VERS LA PAGE (nom du controller / nom de la methode)
        // LE DEUXIEME PARAMETRE EST UN TABLEAU QUI CONTIENT LES PARAMETRES
        // EXEMPLE : ICI LE CHEMIN VERS LA PAGE EST "../home" ET LES PARAMETRES SONT "id" ET "name"
        $this->redirect('../home', array('id' => 1, 'name' => 'test'));

        // CONVERTIR UNE DATE SQL EN DATE FRANCAISE
        // LE PARAMETRE EST LA DATE SQL
        // EXEMPLE : ICI LA DATE SQL EST "2021-05-05 00:00:00" ET LA DATE FRANCAISE EST "05/05/2021"
        $this->convertDateFrench('2021-05-05 00:00:00');

        // RECUPERER L'ID DE L'UTILISATEUR CONNECTE
        $this->getUserId();

        // RECUPERER UNE IMAGE ALEATOIRE DANS UN DOSSIER
        // LE PARAMETRE EST LE CHEMIN VERS LE DOSSIER
        // EXEMPLE : ICI LE CHEMIN VERS LE DOSSIER EST "assets/images/avatar/head/"
        $this->randomImg('assets/images/avatar/head/');

        // FAIS LA MEME CHOSE QUE LA FONCTION var_dump() MAIS EN PLUS LISIBLE 
        dump($data);



        // PERMET D'AFFICHER LA VUE PAR DEFAUT DU CONTROLLER
        // LE CHEMIN VERS LA VUE COMMENCE DANS LE DOSSIER "Views"
        // LA FONCTION COMPACT PERMET DE TRANSFORMER LES CLES DU TABLEAU EN VARIABLES
        // EXEMPLE : ICI LA VARIABLE $page_name EST CREEE ET CONTIENT LE TABLEAU $page_name
        // LA CONSTANTE DASHBOARD PERMET DE DEFINIR LE TYPE DE PAGE A AFFICHER (DASHBOARD / OTHERS / NO_LAYOUT)
        // DASHBOARD = PAGE AVEC LE MENU DE NAVIGATION ET LA SIDE BAR
        // OTHERS = PAGE SANS LE MENU DE NAVIGATION ET LA SIDE BAR
        // NO_LAYOUT = PAGE SANS AUCUNE MISE EN PAGE (IL EST NECESSAIRE DE CREER UNE VUE AVEC TOUT LE CODE HTML)
        $this->render($this->default_path, compact('user', 'subscription', 'page_name'), DASHBOARD);
        
        // LE DERNIER PARAMETRE EST FACULTATIF ET PERMET DE DEFINIR LMANUELLEMENT LA VARIABLE $path_prefix EN CAS DE BUG
        $this->render($this->default_path, compact('user', 'subscription', 'page_name'), DASHBOARD, '../');

    }

}
