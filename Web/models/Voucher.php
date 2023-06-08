<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Voucher extends Model
{
/**
     * event constructor.
     */
    public function __construct()
    {
        $this->table = "voucher";

        $this->getConnection();
    }

    /**
     * Get the voucher of a user
     * @param int $userId
     * @return mixed
     */
    public function getVouchersByUserId(int $userId)
    {
        $sql = "SELECT * FROM voucher WHERE id_voucher IN (SELECT id_voucher FROM can_optains WHERE id_users = :userId AND used = 0)";

        $query = $this->_connexion->prepare($sql);

        $data = [
            "userId" => $userId
        ];

        $query->execute($data);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the voucher by id Voucher
     * @param int $id
     * @return array
     */
    public function getVoucherById(int $id): array
    {
        $sql = "SELECT * FROM voucher WHERE id_voucher = :id";

        $query = $this->_connexion->prepare($sql);

        $data = [
            "id" => $id
        ];

        $query->execute($data);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Add a voucher to a user
     * @param int $userId
     * @param string $name
     * @param int $amount
     * @param string $currency
     * @return bool
     */
    public function addVoucher(int $userId, string $name, int $amount, string $currency): bool
    {
        $sql = "INSERT INTO voucher (name,amount,currency) VALUES (:name,:amount,:currency)";

        $query = $this->_connexion->prepare($sql);

        $data = [
            "name" => $name,
            "amount" => $amount,
            "currency" => $currency
        ];

        $query->execute($data);

        $id_voucher = $this->_connexion->lastInsertId();

        $sql = "INSERT INTO can_optains (id_users,id_voucher) VALUES (:userId,:id_voucher)";

        $query = $this->_connexion->prepare($sql);

        $data = [
            "userId" => $userId,
            "id_voucher" => $id_voucher
        ];

        return $query->execute($data);
    }

    /**
     * Check if a voucher exist
     * @param int $id
     * @return bool
     */
    public function checkVoucher(int $id): bool
    {
        $sql = "SELECT * FROM voucher WHERE id_voucher = :id";

        $query = $this->_connexion->prepare($sql);

        $data = [
            "id" => $id
        ];

        $query->execute($data);

        return $query->rowCount() > 0;
    }

    /**
     * Update the voucher to used
     * @param int $idVoucher
     * @param int $idUser
     * @return bool
     */
    public function updateVoucher(int $idVoucher, int $idUser): bool
    {
        $sql = "UPDATE can_optains SET used = 1 WHERE id_voucher = :idVoucher AND id_users = :idUser";

        $query = $this->_connexion->prepare($sql);

        $data = [
            "idVoucher" => $idVoucher,
            "idUser" => $idUser
        ];

        return $query->execute($data);
    }

}