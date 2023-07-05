<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Avatar extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "avatar";

        $this->getConnection();
    }

    /**
     * CheckIfUserGetAvatar
     * @param int $id
     * @return bool
     */
    public function CheckIfUserGetAvatar(int $id): bool
    {
        $query = "SELECT id_users FROM ". $this->table ." WHERE id_users = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get avatar by id
     * @param int $id
     * @return array
     */
    public function getAvatar(int $id): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_users = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create avatar
     * @param int $id
     * @param string $head
     * @param string $eyes
     * @param string $nose
     * @param string $mouth
     * @param string $brows
     * @return bool
     */
    public function createAvatar(int $id, string $head, string $eyes, string $nose, string $mouth, string $brows): bool
    {
        $query = "INSERT INTO " . $this->table . " (id_users, head, eyes, nose, mouth, brows) VALUES (:id, :head, :eyes, :nose, :mouth, :brows)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":head", $head);
        $stmt->bindParam(":eyes", $eyes);
        $stmt->bindParam(":nose", $nose);
        $stmt->bindParam(":mouth", $mouth);
        $stmt->bindParam(":brows", $brows);

        return $stmt->execute();
    }

    /**
     * Update avatar
     * @param int $id
     * @param string $head
     * @param string $eyes
     * @param string $nose
     * @param string $mouth
     * @param string $brows
     * @return bool
     */
    public function updateAvatar(int $id, string $head, string $eyes, string $nose, string $mouth, string $brows): bool
    {
        $query = "UPDATE " . $this->table . " SET head = :head, eyes = :eyes, nose = :nose, mouth = :mouth, brows = :brows WHERE id_users = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":head", $head);
        $stmt->bindParam(":eyes", $eyes);
        $stmt->bindParam(":nose", $nose);
        $stmt->bindParam(":mouth", $mouth);
        $stmt->bindParam(":brows", $brows);

        return $stmt->execute();
    }


}

?>