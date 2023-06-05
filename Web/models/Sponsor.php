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
        $sql = "SELECT sponsor_link FROM users WHERE id_users = :userId AND sponsor_link_expiration > NOW()";

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
        $sql = "SELECT sponsor_link_expiration FROM users WHERE id_users = :userId AND sponsor_link_expiration > NOW()";

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
  


}

?>