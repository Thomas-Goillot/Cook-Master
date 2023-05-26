<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class UserSecurity extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "user_ip";

        $this->getConnection();
    }

    public function getUserNotAllowedIp(int $id_users): array
    {
        $query = "SELECT ip FROM " . $this->table . " WHERE id_users = :id_users AND allowed =". IP_NOT_ALLOWED;

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id_users);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get user banned ip
     * @param int $id_users
     * @return array
     */
    public function getUserBannedIp(int $id_users): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_users = :id_users AND allowed =". IP_BANNED;

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id_users);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserIp(int $id_users): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_users = :id_users";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id_users);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addIp(int $id_users, string $ip, int $allowed = IP_NOT_ALLOWED): int
    {
        $query = "INSERT INTO " . $this->table . " (id_users, ip, allowed) VALUES (:id_users, :ip, :allowed)";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_users" => $id_users,
            ":ip" => $ip,
            ":allowed" => $allowed
        );

        $stmt->execute($data);

        return $this->_connexion->lastInsertId();
    }

    public function updateAllowedIp($id_user_ip):bool
    {
        $query = "UPDATE " . $this->table . " SET allowed = ".IP_ALLOWED." WHERE id_user_ip = :id_user_ip";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_user_ip" => $id_user_ip,
        );

        return $stmt->execute($data);
    }

    public function deleteIp($id_user_ip, $id_users):bool
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_user_ip = :id_user_ip AND id_users = :id_users";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_user_ip" => $id_user_ip,
            ":id_users" => $id_users
        );

        return $stmt->execute($data);
    }

    public function checkIp($id_users, $ip):bool
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_users = :id_users AND ip = :ip";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_users" => $id_users,
            ":ip" => $ip
        );

        $stmt->execute($data);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            return true;
        }

        return false;
    }

    public function checkIpAllowed($id_users, $ip):bool
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_users = :id_users AND ip = :ip AND allowed = ".IP_ALLOWED;

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_users" => $id_users,
            ":ip" => $ip
        );

        $stmt->execute($data);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            return true;
        }

        return false;
    }

    public function getIpId($id_users, $ip):int
    {
        $query = "SELECT id_user_ip FROM " . $this->table . " WHERE id_users = :id_users AND ip = :ip";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_users" => $id_users,
            ":ip" => $ip
        );

        $stmt->execute($data);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['id_user_ip'];
    }




}
