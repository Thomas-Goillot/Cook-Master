<?php 

namespace App;

class Utils
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
            password_hash($password, PASSWORD_DEFAULT);
        }

        return $password;
    }


}


?>