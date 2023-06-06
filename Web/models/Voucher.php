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
    public function getVouchers(int $userId)
    {
        $sql = "SELECT * FROM voucher WHERE id_voucher IN (SELECT id_voucher FROM can_optains WHERE id_users = :userId)";

        $query = $this->_connexion->prepare($sql);

        $data = [
            "userId" => $userId
        ];

        $query->execute($data);

        return $query->fetchAll(PDO::FETCH_ASSOC);
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

}