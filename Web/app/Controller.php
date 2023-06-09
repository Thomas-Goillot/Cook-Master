<?php

namespace App;

use App\Utils;
use Exception;

class Controller extends Utils{

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
     * Will contain the css file
     * @var array $css
     */
    private array $css = [];


    /**
     * Render a view
     *
     * @param string $file
     * @param array $data
     * @param string $type
     * @return void
     */
    public function render(string $file, ?array $data, string $type, string $path = ""): void
    {
        //calculate path prefix
        if ($path != "") {
            $data['path_prefix'] = $path;
        }
        else{
            $data['path_prefix'] = $this->pathPrefix();
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
        $data = array_merge(
            $data,
            array('newScript' => $newScript)
        );

        //handle new css 
        $newCss = $this->generateLinkTag($this->getNewCss(), $data['path_prefix']);
        $data = array_merge(
            $data,
            array('newCss' => $newCss)
        );

        //handle params 
        if (isset($_SESSION['params'])) {
            $data = array_merge($data, array('redirectParams' => $_SESSION['params']));
            unset($_SESSION['params']);
        }

        $this->loadModel('User');

        //render view
        if ($type == DASHBOARD) {
            $this->renderDashboard($file, $data);
        } else if ($type == OTHERS) {
            $this->renderOthers($file, $data);
        } else {
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
    private function renderDashboard(string $file, array $data = []): void
    {
        $data['user'] = $this->_model->getUserInfo($_SESSION['user']['id_users']);

        $sidebarAdmin = "";
        $sidebarRh = "";
        $sidebarProviders = "";
        $sidebarGestionnaire = "";
        
        if ($this->isAdmin($_SESSION['user']['id_users'])) {
            $sidebarAdmin = $this->generateFile('views/layout/dashboard/sidebarAdmin.php', $data);
            $sidebarRh = $this->generateFile('views/layout/dashboard/sidebarRh.php', $data);
            $sidebarProviders = $this->generateFile('views/layout/dashboard/sidebarProviders.php', $data);
            $sidebarGestionnaire = $this->generateFile('views/layout/dashboard/sidebarGestionnaire.php', $data);
        }

        if ($this->isRh($_SESSION['user']['id_users'])) {
            $sidebarRh = $this->generateFile('views/layout/dashboard/sidebarRh.php', $data);
        }

        if ($this->isProvider($_SESSION['user']['id_users'])) {
            $sidebarProviders = $this->generateFile('views/layout/dashboard/sidebarProviders.php', $data);
        }

        if($this->isGestionnaire($_SESSION['user']['id_users'])){
            $sidebarGestionnaire = $this->generateFile('views/layout/dashboard/sidebarGestionnaire.php', $data);
        }

        /* SIDE BAR */
        $data = array_merge($data, array('sidebarAdmin' => $sidebarAdmin));
        $data = array_merge($data, array('sidebarRh' => $sidebarRh));
        $data = array_merge($data, array('sidebarProviders' => $sidebarProviders));
        $data = array_merge($data, array('sidebarGestionnaire' => $sidebarGestionnaire));
        
        
        $head = $this->generateFile('views/layout/dashboard/head.php', $data);
        $sidebar = $this->generateFile('views/layout/dashboard/sidebar.php', $data);
        $header = $this->generateFile('views/layout/dashboard/header.php', $data);
        $content = $this->generateFile('views/' . $file . '.php', $data);
        $footer = $this->generateFile('views/layout/dashboard/footer.php', $data);
        $script = $this->generateFile('views/layout/dashboard/script.php', $data);
        $view = $this->generateFile('views/layout/dashboard/default.php', array('head' => $head, 'sidebar' => $sidebar, 'header' => $header, 'content' => $content, 'footer' => $footer, 'script' => $script));
        echo $view;
    }

    /**
     * Render a view for others
     *
     * @param string $file
     * @param array $data
     * @return void
     */
    private function renderOthers(string $file, array $data = []): void
    {

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
    public function loadModel(string $model): void
    {

        $model = "Models\\" . ucfirst($model);
        $this->_model = new $model;
    }

    /**
     * Redirect to a path
     *
     * @param string $path
     * @return void
     */
    public static function redirect(string $path, array $params = []): void{

        if (count($params) > 0) {
            $_SESSION['params'] = $params;
        }
        header('Location: ' . $path);
        exit();
    }


    /**
     * Get error from session
     * @return string|null
     */
    public static function getError(): ?array{
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
    public static function setError(string $title, string $error, string $type = WARNING_ALERT): void{
        $_SESSION['error'] = array('title' => $title, 'error' => $error, 'type' => $type);
    }

    /**
     * Add js file to script.php
     * The specified file must be in the assets/pages folder
     * @param array $js
     */
    public function setJsFile(array $js): void
    {
        foreach ($js as $value) {
            $this->script[] = $value;
        }
    }

    /**
     * Get js file
     * @return array
     */
    public function getNewScript(): array
    {
        return $this->script;
    }

    /**
     * Add css file to head.php
     * The specified file must be in the assets folder
     * @param array $css
     */
    public function setCssFile(array $css): void
    {
        foreach ($css as $value) {
            $this->css[] = $value;
        }
    }

    /**
     * Get css file
     * @return array
     */
    public function getNewCss(): array
    {
        return $this->css;
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

    /**
     * Load avatar for the user
     * @param int $id
     * @param int $width
     * @param int $height
     * @return string
     */
    public function loadAvatar(int $id, string $path_prefix, string $width = "", string $height = ""): string
    {
        $this->loadModel('avatar');

        $avatar = $this->_model->CheckIfUserGetAvatar($id);

        if ($avatar != false || $id = ANONYMOUS) {


            $avatar = $this->_model->getAvatar($id);

            $head = dirname(__DIR__, 1)  . '/assets/images/avatar/head/' . $avatar['head'] . '';
            $eyes = dirname(__DIR__, 1)  . '/assets/images/avatar/eyes/' . $avatar['eyes'] . '';
            $nose = dirname(__DIR__, 1)  . '/assets/images/avatar/nose/' . $avatar['nose'] . '';
            $mouth = dirname(__DIR__, 1) . '/assets/images/avatar/mouth/' . $avatar['mouth'] . '';
            $brows = dirname(__DIR__, 1) . '/assets/images/avatar/brows/' . $avatar['brows'] . '';

            //DO NOT TOUCH (AVATAR SIZE)
            $x = 733;
            $y = 929;

            $final_img = imagecreatetruecolor($x, $y);

            $white = imagecolorallocatealpha($final_img, 0, 0, 0, 127);
            imagefill($final_img, 0, 0, $white);
            imagesavealpha($final_img, true);


            $image_1 = imagecreatefrompng($head);

            $image_2 = imagecreatefrompng($eyes);

            $image_3 = imagecreatefrompng($nose);

            $image_4 = imagecreatefrompng($mouth);

            $image_5 = imagecreatefrompng($brows);

            imagecopyresampled($final_img, $image_1, 0, 0, 0, 0, $x, $y, $x, $y);
            imagecopyresampled($final_img, $image_2, 0, 0, 0, 0, $x, $y, $x, $y);
            imagecopyresampled($final_img, $image_3, 0, 0, 0, 0, $x, $y, $x, $y);
            imagecopyresampled($final_img, $image_4, 0, 0, 0, 0, $x, $y, $x, $y);
            imagecopyresampled($final_img, $image_5, 0, 0, 0, 0, $x, $y, $x, $y);

            ob_start();


            imagepng($final_img);
            $avatar_img = ob_get_contents();
            ob_end_clean();

            if ($width != "" && $height != "") {
                return '<img src="data:image/png;base64,' . base64_encode($avatar_img) . '" alt="Avatar" style="width:' . $width . ';height:' . $height . '" class="rounded-circle header-profile-user">';
            } else {
                return '<img src="data:image/png;base64,' . base64_encode($avatar_img) . '" alt="Avatar" class="rounded-circle header-profile-user">';
            }
        } else {
            if ($width != "" && $height != "") {
                return '<img src="' . $path_prefix . 'assets/images/users/user.png" alt="Avatar" width="' . $width . '" height="' . $height . '" class="rounded-circle header-profile-user">';
            } else {
                return '<img src="' . $path_prefix . 'assets/images/users/user.png" alt="Avatar" class="rounded-circle header-profile-user">';
            }
        }
    }
}
