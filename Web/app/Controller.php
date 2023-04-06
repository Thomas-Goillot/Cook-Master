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
     * @param string $file
     * @param array $data
     * @param string $type
     * @return void
     */
    public function render(string $file, array $data = [], string $type): void{

        $temp = explode('/', $file);

        
        $data['path_prefix'] = '';
        if(end($temp) != 'index'){
            $data['path_prefix'] = '../';
        }

        if($type == DASHBOARD){
            $this->renderDashboard($file, $data);
        }else{
            $this->renderOthers($file, $data);
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
    private function generateFile(string $file, array $data): string
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
}