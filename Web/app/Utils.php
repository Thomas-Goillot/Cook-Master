<?php 

namespace App;

use App\Mail;

class Utils extends Security
{

    /**
     * Env file
     *
     * @var array
     */
    public array $env;

    /**
     * Get data from .env file
     */
    public function getEnv():void
    {
        $this->env = parse_ini_file(__DIR__ . "/../config/.env");
    }

    /**
     * Calculate path prefix
     * @param string $path
     * @return string
     */
    public function pathPrefix(string $path): string
    {
        $temp = explode('/', $path);

        $path_prefix = '';
        if (end($temp) != 'index') {
            $path_prefix = '../';
        }

        return $path_prefix;
    }

    /**
     * Hash password
     * @param string $password
     * @return string
     */
    public function hashPassword(string $password): string
    {

        for ($i = 0; $i < PASSWORD_COST; $i++) {
            $password = hash('sha256', $password . PASSWORD_SALT);
        }

        return $password;
    }

    /**
     * convert date to french format
     * @param string $date
     * @return string
     */
    public function convertDateFrench(string $date): string
    {
        // $date = "2021-01-01 00:00:00";
        $date = explode(" ", $date);
        $date = explode("-", $date[0]);
        $date = $date[2] . "/" . $date[1] . "/" . $date[0];

        return $date;
    }

    /**
     * Generate a random string of length $length
     * @param int $length
     * @return string
     */
    public static function generateRandomString(int $length = 10): string{
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    /**
     * Generate a random int of length $length
     * @param int $length
     * @return string
     */
    public function generateRandomNumber(int $length = 10): string{
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Account is verified by email
     * @param int $value
     * @return bool
     */

    public function isVerified(int $value): string{
        if($value == 1){
            return "<span class='text-success'>Validé</span>";
        }
        return "<span class='text-danger'>Non Validé</span>";
    }

    /**
     * Check if something is active or not
     * @param int $value
     * @return bool
     */

    public function isActive(int $value): string
    {
        if ($value == 1) {
            return "<span class='text-success'>Actif</span>";
        }
        return "<span class='text-danger'>innactif</span>";
    }

    /**
     * Get the page name
     * @param array $page_name
     * @return string
     */
    public function getPageName(array $page_name): string
    {
        $page_name = array_keys($page_name);
        $page_name = end($page_name);
        return $page_name;
    }

    /**
     * Display an alerts
     * @param string $title
     * @param string $message
     * @param string $type
     * @return string
     */
    public function alert(string $title, string $message = "", string $type = ERROR_ALERT): string
    {
        return "<script>
        Swal.fire(
        {
            position: 'top-end',
            title: '$title',
            text: '$message',
            type: '$type',
            timer: 4000,
            confirmButtonClass: 'btn btn-confirm mt-2'
        })</script>";
    }

    /**
     * Create script tag for js files
     */
    public function generateScriptTag(array $scripts, string $path_prefix): string
    {
        $script = "";
        foreach ($scripts as $value) {
            $script .= "<script src='".$path_prefix."assets/pages/".$value."'></script>";
        }
        return $script;
    }

    /**
     * Create link tag for css files
     */
    public function generateLinkTag(array $links, string $path_prefix): string
    {
        $link = "";
        foreach ($links as $value) {
            $link .= "<link href='".$path_prefix."assets/".$value."' rel='stylesheet' type='text/css' />";
        }
        return $link;
    }

    /**
     * Get user id from session
     * @return int
     */
    public function getUserId(): int
    {
        if(!isset($_SESSION['user']['id_users'])){
            return ANONYMOUS;
        }
        return $_SESSION['user']['id_users'];
    }

    /**
     * Get random image from a directory
     * @param string $dir
     */
    public function randomImg($dir)
    {

        $imgs_arr = array();

        if (file_exists($dir) && is_dir($dir)) {

            $dir_arr = scandir($dir);
            $arr_files = array_diff($dir_arr, array('.', '..'));

            foreach ($arr_files as $file) {

                $file_path = $dir . "/" . $file;

                $ext = pathinfo($file_path, PATHINFO_EXTENSION);

                if ($ext == "jpg" || $ext == "png" || $ext == "JPG" || $ext == "PNG") {

                    array_push($imgs_arr, $file);
                }
            }

            $count_img_index = count($imgs_arr) - 1;

            return $imgs_arr[rand(0, $count_img_index)];
        }
    }

    /**
     * getAllImg of a folder
     */
    public function getAllImg(string $folder): array
    {
        $files = scandir($folder);
        $files = array_diff($files, array('.', '..'));
        $files = array_values($files);
        return $files;
    }

    /**
     * Get domain name
     */
    public function getDomainName(): string
    {
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
            $link = "https";
        }else{
            $link = "http";
        }

        self::getEnv();

        if($this->env['ENV'] === "DEV"){
            return $link . "://" . $_SERVER['HTTP_HOST'] . "/Cook-Master/WEB/";
        }

        return $link . "://" . $_SERVER['HTTP_HOST']."/";
    }
}
