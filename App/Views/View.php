<?php 

namespace App\Views;
use FFI\Exception;

class View {


    private $_file;

    private $_page;

    public function __construct($action, $page)
    {
        $this->_file = 'views/view' . ucfirst($action) . '.php';
        $this->_page = $page;
    }

    public function generate(array $data = array()):void
    {
        $head = $this->generateFile('view/template/head.php', $data);
        $sidebar = $this->generateFile('view/template/sidebar.php', $data);
        $header = $this->generateFile('view/template/header.php', $data);
        $content = $this->generateFile($this->_file, $data);
        $footer = $this->generateFile('view/template/footer.php', $data);
        $script = $this->generateFile('view/template/script.php', $data);


        $view = $this->generateFile('view/template/base.php', array(
            'head' => $head,
            'sidebar' => $sidebar,
            'header' => $header,
            'content' => $content,
            'footer' => $footer,
            'script' => $script
        ));

        echo $view;
    }

    private function generateFile(string $file, array $data):string
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

}



?>