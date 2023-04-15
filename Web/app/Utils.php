<?php 

namespace App;

use App\Mail;

abstract class Utils extends Security
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
    public function getEnv()
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
     * Encode data in base64
     * @param string $data
     * @return string
     */
    public function encode(string $data): string
    {
        return base64_encode($data);
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
    public function generateRandomString(int $length = 10): string{
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
     * Calcul si faut mettre un s ou pas
     * @param int $number
     * @return string
     */
    public function plural(int $number): string
    {
        if ($number > 1) {
            return "s";
        }
        return "";
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
     * Get user id from session
     * @return int
     */
    public function getUserId(): int
    {
        return $_SESSION['user']['id_users'];
    }

}
