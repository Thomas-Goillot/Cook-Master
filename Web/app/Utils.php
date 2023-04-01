<?php 

namespace App;

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



}

?>