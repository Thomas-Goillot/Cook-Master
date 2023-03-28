<?php

namespace App;

abstract class Controller{

    /**
     * Will contain the model
     *
     * @var object
     */
    public object $_model;


    /**
     * Render a view
     *
     * @param string $fichier
     * @param array $data
     * @return void
     */
    public function render(string $fichier, array $data = []): void{
        extract($data);

        ob_start();

        $path = ROOT . 'views/' . $fichier . '.php';

        if(file_exists($path)){
            require_once($path);
        }else{
            echo "Le fichier $path n'existe pas";
        }

        $content = ob_get_clean();

        require_once(ROOT.'views/layout/default.php');
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
}