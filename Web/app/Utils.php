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



}
