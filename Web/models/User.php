<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

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
     * @return array|bool
     */
    public function getInfo(int $id)
    {
        $query = "SELECT id_users, email, name, surname, address, city, country, phone, zip_code, is_banned, sponsor_counter, id_access, creation_date,mail_verified FROM " . $this->table . " WHERE id_users = :id";

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
    public function checkUserExist(string $email):bool
    {
        try{
            $query = "SELECT id_users FROM " . $this->table . " WHERE email = :email";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":email", $email);

            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                return false;
            }

            return true;
        }
        catch (PDOException $e){
            return false;
        }
    }

    /**
     * Check if user exist and password is correct
     * @param string $email
     * @param string $password
     * @return array|bool
     */
    public function checklogin(string $email, string $password){
        try {
            $query = "SELECT id_users FROM " . $this->table . " WHERE email = :email AND password = :password";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);

            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                return array();
            }

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return array("error" => "Une erreur est survenue lors de la connexion", "message" => $e->getMessage());
        }
    }

    /**
     * Register user
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $phone
     * @param string $password
     */
    public function register(string $name, string $surname, string $email, string $phone, string $password){

        try {

        $query = "INSERT INTO " . $this->table . " (name, surname, email, phone, password) VALUES (:name, :surname, :email, :phone, :password)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":surname", $surname);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":password", $password);

        return $stmt->execute();

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Check if user as verified his email
     * @param int $id
     * @return bool
     */
    public function checkMailVerified(int $id):bool{
        try {
            $query = "SELECT mail_verified FROM " . $this->table . " WHERE id_users = :id";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            if($stmt->rowCount() == 0){
                return false;
            }

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['mail_verified'] != MAIL_VERIFIED) {
                return false;
            }

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * get mail by id user
     * @param int $id
     * @return string
     */
    public function getMailById(int $id):string{
        try {
            $query = "SELECT email FROM " . $this->table . " WHERE id_users = :id";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            if($stmt->rowCount() == 0){
                return "";
            }

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['email'];

        } catch (PDOException $e) {
            return "";
        }
    }

    /**
     * Update valide code for user
     * @param int $id
     * @param string $code
     * @return bool
     */
    public function setValidationCode(int $id, string $code):bool{
        try {
            $query = "UPDATE " . $this->table . " SET validation_code = :code WHERE id_users = :id";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":code", $code);

            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Check if valide code is correct
     * @param int $id
     * @param string $code
     * @return bool
     */
    public function checkCode(int $id, string $code):bool{
        try {

            $query = "SELECT validation_code FROM " . $this->table . " WHERE id_users = :id AND validation_code = :code";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":code", $code);

            $stmt->execute();

            if($stmt->rowCount() == 0){
                return false;
            }

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Update mail verified
     * @param int $id
     * @return bool
     */

    public function setMailVerified(int $id):bool{
        try {
            $query = "UPDATE " . $this->table . " SET mail_verified = :mail_verified WHERE id_users = :id";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":id", $id);
            $mail_verified = MAIL_VERIFIED;
            $stmt->bindParam(":mail_verified", $mail_verified);

            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
    }
}
