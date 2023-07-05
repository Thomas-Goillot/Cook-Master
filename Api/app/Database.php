<?php 

namespace App;
use PDO;
use PDOException;

class Database
{
    protected $pdo;

    public function __construct()
    {
        $dsn = "mysql:host=193.70.42.195;dbname=cookmaster;charset=utf8mb4";

        try {
            $this->pdo = new PDO($dsn, "root", "SecureBD24");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }

    protected function executeQuery($query, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die('Erreur lors de l\'exécution de la requête : ' . $e->getMessage());
        }
    }
}