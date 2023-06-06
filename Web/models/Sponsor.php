<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Sponsor extends Model
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
     * Get the sponsor link
     * @param int $userId
     * @return mixed
     */
    public function getSponsorLink(int $userId)
    {
        $sql = "SELECT sponsor_link FROM users WHERE id_users = :userId";

        $query = $this->_connexion->prepare($sql);

        $data = [
            "userId" => $userId
        ];

        $query->execute($data);

        return $query->fetch(PDO::FETCH_ASSOC)['sponsor_link'];
    }

    /**
     * Get the sponsor link expiration date
     * @param int $userId
     * @return mixed
     */
    public function getSponsorLinkExpirationDate(int $userId)
    {
        $sql = "SELECT sponsor_link_expiration FROM users WHERE id_users = :userId";

        $query = $this->_connexion->prepare($sql);

        $data = [
            "userId" => $userId
        ];

        $query->execute($data);

        return $query->fetch(PDO::FETCH_ASSOC)['sponsor_link_expiration'];
    }

    /**
     * Update the sponsor_counter
     * @param int $userId
     * @return bool
     */
    public function updateSponsorCounter(int $userId): bool
    {
        $sql = "UPDATE users SET sponsor_counter = sponsor_counter + 1 WHERE id_users = :userId";

        $query = $this->_connexion->prepare($sql);

        $data = [
            "userId" => $userId
        ];

        return $query->execute($data);
    }

    /**
     * Add a link in the database
     * @param string $link
     * @param string $expirationDate
     * @param int $userId
     * @return bool
     */
    public function addLink(string $link, string $expirationDate, int $userId): bool
    {
        $sql = "UPDATE users SET sponsor_link = :link, sponsor_link_expiration = :expiration_date WHERE id_users = :userId";

        $query = $this->_connexion->prepare($sql);

        $data = [
            "link" => $link,
            "expiration_date" => $expirationDate,
            "userId" => $userId
        ];

        return $query->execute($data);
    }

    /**
     * checkLink $sponsorLink, $pass, $idUserSponsor
     * @param string $pass
     * @param int $idUserSponsor
     * @return bool 
     */
    public function checkLink(string $pass, int $idUserSponsor): bool
    {
        $sql = "SELECT COUNT(id_users) AS count FROM users WHERE sponsor_link = :pass AND id_users = :idUserSponsor";

        $query = $this->_connexion->prepare($sql);

        $data = [
            "pass" => $pass,
            "idUserSponsor" => $idUserSponsor
        ];

        $query->execute($data);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Incremet the sponsor counter
     * @param int $idUserSponsor
     * @return bool
     */
    public function incrementSponsorCounter(int $idUserSponsor): bool
    {
        $sql = "UPDATE users SET sponsor_counter = sponsor_counter + 1 WHERE id_users = :idUserSponsor";

        $query = $this->_connexion->prepare($sql);

        $data = [
            "idUserSponsor" => $idUserSponsor
        ];

        return $query->execute($data);
    }
  


}

?>