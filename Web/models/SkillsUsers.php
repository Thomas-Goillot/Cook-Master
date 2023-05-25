<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Skillsusers extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "skills";

        $this->getConnection();
    }

    /**
     * Get the id of the certificate the user is working on
     * @param int $id_user
     * @return array
     */
    public function getIdCertificatesUserIsWorkingOnByIdUser(int $id_user): array
    {
        $query = "SELECT id_certificate FROM on_validate WHERE id_skills IN (SELECT id_skills FROM optains WHERE id_users = :id_user)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_user", $id_user);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the certificate info
     * @param int $id_certificate
     * @return array
     */
    public function getCertificateInfo(int $id_certificate): array
    {
        $query = "SELECT * FROM certificate WHERE id_certificate = :id_certificate";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_certificate", $id_certificate);

        $stmt->execute();

        $certificate = $stmt->fetch(PDO::FETCH_ASSOC);

        $query = "SELECT * FROM skills WHERE id_skills IN (SELECT id_skills FROM on_validate WHERE id_certificate = :id_certificate)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_certificate", $id_certificate);

        $stmt->execute();

        $skills = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $certificate['skills'] = $skills;

        return $certificate;
    }

    /**
     * Get the skills validated by the user and attach them to the certificate
     * @param int $id_user
     * @param int $id_certificate
     * @return array
     */
    public function getSkillsValidatedByUser(int $id_user): array
    {
        $query = "SELECT * FROM skills WHERE id_skills IN (SELECT id_skills FROM optains WHERE id_users = :id_user AND id_skills IN (SELECT id_skills FROM on_validate WHERE id_certificate IN (SELECT id_certificate FROM on_validate WHERE id_skills IN (SELECT id_skills FROM optains WHERE id_users = :id_user))))";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_user", $id_user);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the id of the certificate by the id of the skills
     * @param int $id_skills
     * @return int
     */
    public function getIdCertificateByIdSkills(int $id_skills): array
    {
        $query = "SELECT id_certificate FROM on_validate WHERE id_skills = :id_skills";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_skills", $id_skills);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $key => $value) {
            $result[$key] = $value['id_certificate'];
        }

        return $result;
    }


}

?>