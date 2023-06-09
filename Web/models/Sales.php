<?php
namespace Models;

use PDO;
use App\Model;
use PDOException;

class Sales extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "shopping_cart";

        $this->getConnection();
    }

    /**
     * allSales
     * @return array
     */
    public function allSales(): array
    {
        $sql = "SELECT * FROM $this->table";

        $query = $this->_connexion->prepare($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getAllSales
     * @return array
     */
    public function getAllSales(): array
    {
        $sql = "SELECT * FROM $this->table WHERE id_command_status =" . CART_VALIDATE;

        $query = $this->_connexion->prepare($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getAllSalesThisMonth
     * @return array
     */
    public function getAllSalesThisMonth(): array
    {
        $sql = "SELECT * FROM $this->table WHERE id_command_status =" . CART_VALIDATE . " AND MONTH(date_purchase) = MONTH(CURRENT_DATE())";

        $query = $this->_connexion->prepare($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * GetAllDelivered
     * @return array
     */
    public function GetAllDelivered(): array
    {
        $sql = "SELECT * FROM $this->table WHERE id_command_status =" . CART_DELIVERED. " AND MONTH(date_purchase) = MONTH(CURRENT_DATE())";

        $query = $this->_connexion->prepare($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getAllArchived
     * @return array
     */
    public function getAllArchived(): array
    {
        $sql = "SELECT * FROM $this->table WHERE id_command_status =" . CART_ARCHIVED . " AND MONTH(date_purchase) = MONTH(CURRENT_DATE())";

        $query = $this->_connexion->prepare($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}