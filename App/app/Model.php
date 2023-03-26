<?php
abstract class Model{
    /**
     * Host name
     * @var string
     */
    private string $host = "localhost";

    /**
     * Database name
     * @var string
     */
    private string $db_name = "cookmaster_dev";

    /**
     * Username to database
     * @var string
     */
    private string $username = "root";

    /**
     * Password to database
     * @var string
     */
    private string $password = "root";

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
}