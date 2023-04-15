<?php

namespace Controllers;

use App\Controller;

class Moderation extends Controller
{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "moderation/wordlist";

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
     * Display page moderation
     * @return void
     */
    public function wordList(): void
    {
        $this->loadModel('words');
        $swearWords = $this->_model->getSwearWords();

        $page_name = array("Modération" => "", "Mots" => "wordlist");

        $this->render("moderation/wordlist", compact('page_name', 'swearWords'), DASHBOARD);
    }

    /**
     * Add a word to the swear word list
     * @return void
     */
    public function addWord(): void
    {
        $this->loadModel('words');

        $word = $_POST['word'];

        if (strlen($word) > 100) {
            $this->setError("Erreur lors de l\'ajout du mot",'Le mot est trop long',ERROR_ALERT);
            $this->redirect('../moderation/wordlist');
            exit();
        }


        $res = $this->_model->addSwearWord($word);

        if ($res === false) {
            $this->setError("Erreur", "Erreur lors de l\'ajout du mot",ERROR_ALERT);
            $this->redirect('../moderation/wordlist');
            exit();
        }

        $this->setError("Succès", "Le mot a bien été ajouté",SUCCESS_ALERT);

        $this->redirect('../moderation/wordlist');
    }

    /**
     * Delete a word from the swear word list
     * @return void
     */
    public function deleteWord(): void
    {
        $this->loadModel('words');

        $id = $_POST['WordId'];

        var_dump($id);

        $res = $this->_model->deleteSwearWord($id);

        if ($res === false) {
            $this->setError("Erreur", "Erreur lors de la suppression du mot",ERROR_ALERT);
            $this->redirect('../moderation/wordlist');
            exit();
        }

        $this->setError("Succès", "Le mot a bien été supprimé",SUCCESS_ALERT);

        $this->redirect('../moderation/wordlist');
    }

}
