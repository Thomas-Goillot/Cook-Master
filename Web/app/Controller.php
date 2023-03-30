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
     * Render a view
     *
     * @param string $fichier
     * @param array $data
     * @return void
     */
    public function render(string $fichier, array $data = [], string $type): void{

        if($type == DASHBOARD){
            $this->renderDashboard($fichier, $data);
        }else{
            $this->renderOthers($fichier, $data);
        }
        
    }    

    /**
     * Render a view for dashboard
     *
     * @param string $fichier
     * @param array $data
     * @return void
     */
    private function renderDashboard(string $fichier, array $data = []): void{

        $head = $this->generateFile('views/layout/dashboard/head.php', $data);
        $sidebar = $this->generateFile('views/layout/dashboard/sidebar.php', $data);
        $header = $this->generateFile('views/layout/dashboard/header.php', $data);
        $content = $this->generateFile('views/' . $fichier . '.php', $data);
        $footer = $this->generateFile('views/layout/dashboard/footer.php', $data);
        $script = $this->generateFile('views/layout/dashboard/script.php', $data);
        $view = $this->generateFile('views/layout/dashboard/default.php', array('head' => $head, 'sidebar' => $sidebar, 'header' => $header, 'content' => $content, 'footer' => $footer, 'script' => $script));
        echo $view;
    }

    /**
     * Render a view for others
     *
     * @param string $fichier
     * @param array $data
     * @return void
     */
    private function renderOthers(string $fichier, array $data = []): void{

        $head = $this->generateFile('views/layout/others/head.php', $data);
        $content = $this->generateFile('views/' . $fichier . '.php', $data);
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
    private function generateFile(string $file, array $data): string
    {
        if (file_exists($file)) {
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        } else {
            throw new Exception('Fichier ' . $file . ' introuvable');
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
}