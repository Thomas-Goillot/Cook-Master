<?php

namespace App;

use PDO;
use App\Utils;
use PDOException;

abstract class Model extends Utils{
    
    /**
     * Host name
     * @var string
     */
    private string $host = 'sportplus.ddns.net';

    /**
     * Database name
     * @var string
     */
    private string $db_name = "cookedmaster_dev";

    /**
     * Username to database
     * @var string
     */
    private string $username = "cookedmaster_dev";

    /**
     * Password to database
     * @var string
     */
    private string $password = "lk994jQZaAIDsggS";

    /**
     * Connexion to database
     *
     * @var $_connexion
     */
    protected $_connexion;

    /**
     * Table name
     *
     * @var string
     */
    public string $table;


    /**
     * Connexion to database
     *
     * @return void
     */
    public function getConnection(){
        $this->_connexion = null;

        $this->getEnv();
        $this->setEnv();        

        try{
            $this->_connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->_connexion->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    /**
     * Get all data from database
     *
     * @return array
     */
    public function getAll():array{
        $sql = "SELECT * FROM ".$this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();    
    }

    private function setEnv()
    {
        $this->host = $this->env['DB_HOST'];
        $this->db_name = $this->env['DB_NAME'];
        $this->username = $this->env['DB_NAME'];
        $this->password = $this->env['DB_PASS'];
    }

}