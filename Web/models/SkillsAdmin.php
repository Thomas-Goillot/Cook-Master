<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class skillsAdmin extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "certificate";

        $this->getConnection();
    }

    /**
     * Get all skills
     * @return array
     */
    public function getAllSkills(): array
    {
        $query = "SELECT * FROM skills";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Add a skill
     * @param string $name
     * @param string $description
     * @return bool
     */
    public function addSkill(string $name, string $description):bool
    {
        $query = "INSERT INTO skills (name, description) VALUES (:name, :description)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);

        return $stmt->execute();
    }

    /**
     * Get all certificates
     * @return array
     */
    public function getAllCertificates(): array
    {
        $query = "SELECT * FROM " . $this->table;

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Add a certificate
     * @param string $name
     * @param string $description
     * @return int
     */
    public function addCertificate(string $name, string $description): int
    {
        $query = "INSERT INTO " . $this->table . " (name, description) VALUES (:name, :description)";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":name" => $name,
            ":description" => $description,
        );

        $stmt->execute($data);

        return $this->_connexion->lastInsertId();
    }

    /**
     * Add a skill to a certificate
     */
    public function addCertificateSkill(int $idCertificate, int $idSkill):bool
    {
        $query = "INSERT INTO on_validate (id_certificate, id_skills) VALUES (:id_certificate, :id_skills)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_certificate", $idCertificate);
        $stmt->bindParam(":id_skills", $idSkill);

        return $stmt->execute();
    }

    /**
     * Add a skill to a user
     * @param int $id_users
     * @param int $id_skills
     * @return bool
     */
    public function addSkillToUser(int $id_users, int $id_skills):bool
    {
        //check if the user already have the skill
        $query = "SELECT * FROM optains WHERE id_users = :id_users AND id_skills = :id_skills";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_users", $id_users);

        $stmt->bindParam(":id_skills", $id_skills);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return false;
        } else {
            $query = "INSERT INTO optains (id_users, id_skills) VALUES (:id_users, :id_skills)";

            $stmt = $this->_connexion->prepare($query);

            $stmt->bindParam(":id_users", $id_users);

            $stmt->bindParam(":id_skills", $id_skills);

            return $stmt->execute();
        }
    }

}

?>