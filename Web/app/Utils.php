<?php 

namespace App;

use App\Mail;

abstract class Utils
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
     * Check if the user is logged in
     * @return bool
     */

    public function isLogged(): bool
    {
        session_start();
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
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


}
