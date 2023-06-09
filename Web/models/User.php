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
    public function getUserInfo(int $id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_users = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get user name and surname by id
     * @param int $id
     * @return array|bool
     */
    public function getUserName(int $id): array
    {
        $query = "SELECT name, surname FROM " . $this->table . " WHERE id_users = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Check if user exist
     * @param int $id
     * @return bool
     */
    public function checkUserExist(int $id):bool
    {
        try{
            $query = "SELECT COUNT(id_users) FROM " . $this->table . " WHERE id_users = :id";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            if($stmt->fetchColumn() == 0){
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
            $query = "SELECT id_users,name FROM " . $this->table . " WHERE email = :email AND password = :password";

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
        $query = "INSERT INTO " . $this->table . " (name, surname, email, phone, password) VALUES (:name, :surname, :email, :phone, :password);";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":surname", $surname);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":password", $password);

        $val =  $stmt->execute();

        $query = "INSERT INTO subscribe_to (id_users,id_subscription) VALUES (LAST_INSERT_ID(),1)";

        $stmt = $this->_connexion->prepare($query);

        $val2 = $stmt->execute();

        if($val && $val2){
            return true;
        }

        return false;
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

    /**
     * Get user subscription name
     * @param int $id
     * @return string
     */
    public function getUserSubscriptionName(int $id):string{
        try {
            $query = "SELECT name FROM subscription WHERE id_subscription = (SELECT id_subscription FROM subscribe_to WHERE id_users = :id)";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['name'];

        } catch (PDOException $e) {
            return "No subscription";
        }
    }

    /**
     * Get user subscription id
     * @param int $id
     * @return int
     */
    public function getUserSubscriptionId(int $id):int{
            $query = "SELECT id_subscription FROM subscribe_to WHERE id_users = :id";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['id_subscription'];
    }

    /**
     * Check if user is ban by id
     * @param int $id
     * @return bool
     */
    public function checkIsBanUserById(int $id):bool{
        try {
            $query = "SELECT COUNT(is_banned) FROM " . $this->table . " WHERE id_users = :id AND is_banned = ". USER_IS_BANNED ."";
            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            if($res['COUNT(is_banned)'] == 0){
                return false;
            }

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Check if user is ban
     * @param string $email
     * @return bool
     */
    public function checkIsBanUserByMail(string $email): bool
    {
        try {
            $query = "SELECT COUNT(is_banned) FROM " . $this->table . " WHERE email = :email AND is_banned = " . USER_IS_BANNED . "";
            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":email", $email);

            $stmt->execute();

            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($res['COUNT(is_banned)'] == 0) {
                return false;
            }

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Update is ban user
     * @param int $id
     * @param int $banned
     * @return bool
     */
    public function updateIsBanUser(int $id, int $banned):bool{
        try {
            $query = "UPDATE " . $this->table . " SET is_banned = :banned WHERE id_users = :id";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":banned", $banned);

            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Get user censure_Chat
     * @param int $id
     * @return bool
     */
    public function getUserCensureChat(int $id):bool{
        try {
            $query = "SELECT censure_tchat FROM " . $this->table . " WHERE id_users = :id";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if($result['censure_tchat'] == 0){
                return false;
            }

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Get userPasswords
     * @return array
     */
    public function getUserPasswords(int $id_users):array{
        try {
            $query = "SELECT password FROM " . $this->table . " WHERE id_users = :id_users";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":id_users", $id_users);

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            return array();
        }
    }



    /**
     * Get edit userInfo
     * @return void
     */
    public function editUserInfo(string $name, string $surname, int $id_users):void
    {
        $query = "UPDATE " . $this->table . " SET name = :name, surname = :surname WHERE id_users = :id_users";
       
        $data = array(
            ':name' => $name,
            ':surname' => $surname,
            ':id_users' => $id_users
        );

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute($data);

    }

    /**
     * Get edit userContact
     * @return void
     */
    public function editUserContact(string $email, string $phone, int $id_users):void
    {
        $query = "UPDATE " . $this->table . " SET email = :email, phone = :phone WHERE id_users = :id_users";
       
        $data = array(
            ':email' => $email,
            ':phone' => $phone,
            ':id_users' => $id_users
        );

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute($data);

    }
    /**
     * Get edit userAddress
     * @return void
     */
    public function editUserAddress(string $country, string $address, string $city, string $zip_code, int $id_users):void
    {
        $query = "UPDATE " . $this->table . " SET country = :country, address = :address, city = :city, zip_code = :zip_code WHERE id_users = :id_users";
       
        $data = array(
            ':country' => $country,
            ':address' => $address,
            ':city' => $city,
            ':zip_code' => $zip_code,
            ':id_users' => $id_users
        );

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute($data);

    }

    /**
     * Get edit userPassword
     * @return void
     */
    public function editUserPassword(string $password, int $id_users):void
    {
        $query = "UPDATE " . $this->table . " SET password = :password WHERE id_users = :id_users";
       
        $data = array(
            ':password' => $password,
            ':id_users' => $id_users
        );

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute($data);
    }

    /**
     * resetSponsorCounter
     * @param int $id_users
     * @return void
     */
    public function resetSponsorCounter(int $id_users):void
    {
        $query = "UPDATE " . $this->table . " SET sponsor_counter = 0 WHERE id_users = :id_users";
       
        $data = array(
            ':id_users' => $id_users
        );

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute($data);
    }


    /**
     * get all curentlocation by id
     * @return mixed
     */
    public function getAllCurentLocationById(int $id_users)
    {
            $query = "SELECT * FROM rent_location WHERE id_users = :id_users AND end_rental > NOW()";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":id_users", $id_users);

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;


    }
    
    /**
     * getLocationByCurentLocationById
     */
    public function getLocationByCurentLocationById(int $id):array
    {
            $query = "SELECT * FROM location WHERE id_location = :id";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;

    }






}
