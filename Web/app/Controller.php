<?php

namespace App;

use App\Utils;
use Exception;

abstract class Controller extends Utils{

    /**
     * Will contain the model
     *
     * @var object
     */
    public object $_model;


    /**
     * Will contain the script file
     * @var array $script
     */
    private array $script = [];

    
    /**
     * Render a view
     *
     * @param string $file
     * @param array $data
     * @param string $type
     * @return void
     */
    public function render(string $file, ?array $data, string $type, string $path = ""): void{
                
        //calculate path prefix
        if ($path != "") {
            $data['path_prefix'] = $path;
        }
        else{
            $data['path_prefix'] = $this->pathPrefix($file);
        }

        //handle error
        $getError = $this->getError();
        $errors = "";
        if (isset($getError)) {
            $errors = $this->alert($getError['title'], $getError['error'], $getError['type']);
        }
        $data = array_merge($data, array('errors' => $errors));

        //handle new script 
        $newScript = $this->generateScriptTag($this->getNewScript(), $data['path_prefix']);
        $data = array_merge($data,
            array('newScript' => $newScript)
        );

        //render view
        if($type == DASHBOARD){
            $this->renderDashboard($file, $data);
        }else if($type == OTHERS){
            $this->renderOthers($file, $data);
        }
        else{
            echo $this->generateFile('views/' . $file . '.php', $data);
        }
    }    

    /**
     * Render a view for dashboard
     *
     * @param string $file
     * @param array $data
     * @return void
     */
    private function renderDashboard(string $file, array $data = []): void{

        $this->loadModel('User');
        
        $data['user'] = $this->_model->getUserInfo($_SESSION['user']['id_users']);
        
        $head = $this->generateFile('views/layout/dashboard/head.php', $data);
        $sidebarAdmin = "";
        if ($data['user']['id_access'] == ACCESS_ADMIN) {
            $sidebarAdmin = $this->generateFile('views/layout/dashboard/sidebarAdmin.php', $data);
        }
        $data = array_merge($data, array('sidebarAdmin' => $sidebarAdmin));
        $sidebar = $this->generateFile('views/layout/dashboard/sidebar.php', $data);
        $header = $this->generateFile('views/layout/dashboard/header.php', $data);
        $content = $this->generateFile('views/' . $file . '.php', $data);
        $footer = $this->generateFile('views/layout/dashboard/footer.php', $data);
        $script = $this->generateFile('views/layout/dashboard/script.php', $data);
        $view = $this->generateFile('views/layout/dashboard/default.php', array('head' => $head, 'sidebar' => $sidebar,'header' => $header, 'content' => $content, 'footer' => $footer, 'script' => $script));
        echo $view;
    }

    /**
     * Render a view for others
     *
     * @param string $file
     * @param array $data
     * @return void
     */
    private function renderOthers(string $file, array $data = []): void{

        $head = $this->generateFile('views/layout/others/head.php', $data);
        $content = $this->generateFile('views/' . $file . '.php', $data);
        $script = $this->generateFile('views/layout/others/script.php', $data);
        $view = $this->generateFile('views/layout/others/default.php', array('head' => $head, 'content' => $content, 'script' => $script));
        echo $view;
    }

    /**
     * Generate a file
     *
     * @param string $file
     * @param array $data
     * @return string
     */
    public function generateFile(string $file, array $data): string
    {
        if (file_exists($file)) {
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        } else {
            throw new Exception('file ' . $file . ' introuvable');
        }
    }

    /**
     * Load a model
     *
     * @param string $model
     * @return void
     */
    public function loadModel(string $model): void{
        
        $model = "Models\\" . $model;
        $this->_model = new $model;
    }

    /**
     * Redirect to a path
     *
     * @param string $path
     * @return void
     */
    public function redirect(string $path): void{
        header('Location: ' . $path);
        exit();
    }


    /**
     * Get error from session
     * @return string|null
     */
    public function getError(): ?array{
        if(isset($_SESSION['error'])){
            $error = $_SESSION['error'];
            unset($_SESSION['error']);
            return $error;
        }
        return null;
    }

    /**
     * Set error in session
     */
    public function setError(string $title, string $error, string $type = WARNING_ALERT): void{
        $_SESSION['error'] = array('title' => $title, 'error' => $error, 'type' => $type);
    }

    /**
     * Add js file to script.php
     * The specified file must be in the assets/pages folder
     * @param array $js
     */
    public function setJsFile(array $js): void{
        foreach ($js as $value) {
            $this->script[] = $value;
        }
    }

    /**
     * Get js file
     * @return array
     */
    public function getNewScript(): array{
        return $this->script;
    }


    /**check if there is some words in the message that are not allowed
     * @param string $message 
     * @return string $message
     */
    public function checkMessage(string $message): string
    {
        $message = trim($message);
        $message = htmlspecialchars($message);
        $message = strip_tags($message);
        $message = str_replace(array("\r", " ", " ", "   ", "    ", "     "), " ", $message);

        return htmlspecialchars_decode($message);
    }


    /**check if there is some words in the message that are not allowed
     * @param string $message 
     * @return string $message
     */
    public function checkSwearWords(string $message): string
    {
        $this->loadModel('words');

        $swearWords = $this->_model->getSwearWordsWithoutId();

        $message = explode(" ", $message);

        foreach ($message as $word) {
            if (in_array($word, $swearWords)) {
                $message = str_replace($word, "****", $message);
            }
        }

        $message = implode(" ", $message);

        return $message;
    }

}