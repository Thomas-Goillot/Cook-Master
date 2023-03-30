<?php

namespace Models;

use PDO;
use App\Model;

class User extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "users";

        $this->getConnection();
    }

    /**
     * Get user info by id
     * @param int $id
     * @return array
     */
    public function getInfo(int $id): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Check if user exist
     * @param string $email
     * @return bool
     */
    public function checkUserExist(string $email): bool
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":email", $email);

        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            return false;
        }

        return true;
    }

    /**
     * Check if user exist and password is correct
     * @param string $email
     * @param string $password
     * @return array|bool
     */
    public function checklogin(string $email, string $password):array{
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email AND password = :password";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);

        $stmt->execute();

        if($stmt->rowCount() == 0){
            return array();
        }      

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
