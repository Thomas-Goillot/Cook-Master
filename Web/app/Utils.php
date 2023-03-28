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

}


?>