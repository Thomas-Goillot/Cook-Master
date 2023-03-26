<?php
abstract class Controller{
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

        require_once(ROOT.'views/'.$fichier.'.php');

        $content = ob_get_clean();

        require_once(ROOT.'views/layout/default.php');
    }


    /**
     * Render a view 
     * @param string $fichier
     * @param array $data
     * @return void
     */
    public function render_other(string $fichier, array $data = []):void{
        extract($data);

        ob_start();

        require_once(ROOT.'views/'.$fichier.'.php');

        $content = ob_get_clean();

        require_once(ROOT.'views/layout/other.php');
    }

    /**
     * Load a model
     *
     * @param string $model
     * @return void
     */
    public function loadModel(string $model): void{
        require_once(ROOT.'models/'.$model.'.php');
        
        $this->$model = new $model();
    }
}