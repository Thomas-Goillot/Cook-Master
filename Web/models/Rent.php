<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Rent extends Model
{
    /**
     * Rent constructor.
     */
    public function __construct()
    {
        $this->table = "rent_cart";

        $this->getConnection();
    }

    /**
     * getAllRent
     * @param int $id
     * @return array
     */
    public function getAllRent(int $id): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_users = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * getUserCartId
     * @param int $id
     * @return mixed
     */
    public function getUserCartId(int $id)
    {
        $query = "SELECT id_rent_cart FROM " . $this->table . " WHERE id_users = :id AND status =" . CART_PROGRESS;

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if($res === false){
            return false;
        }

        return $res['id_rent_cart'];
    }

    /**
     * Get cart info
     * @param int $id
     * @return array
     */
    public function getCart(int $id): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_rent_cart = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * getAllProductInCart
     * @param int $id
     * @return array
     */
    public function getAllProductInCart(int $id): array
    {
        $query = "SELECT * FROM rent_contains INNER JOIN equipment ON rent_contains.id_equipment = equipment.id_equipment WHERE id_rent_cart = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * createCart
     * @param int $id
     * @return bool
     */
    public function createCart(int $id): bool
    {
        $query = "INSERT INTO " . $this->table . " (id_users, status) VALUES (:id, " . CART_PROGRESS . ")";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    /**
     * addProductToCart
     * @param int $idCart
     * @param int $idProduct
     * @param int $numberOfProduct
     * @return bool
     */
    public function addProductToCart(int $idCart, int $idProduct, int $numberOfProduct): bool
    {
        $query = "INSERT INTO rent_contains (id_rent_cart, id_equipment, quantity) VALUES (:idCart, :idProduct, :numberOfProduct)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":idCart", $idCart);
        $stmt->bindParam(":idProduct", $idProduct);
        $stmt->bindParam(":numberOfProduct", $numberOfProduct);

        return $stmt->execute();
    }

    /**
     * updateCartStatus
     * @param int $id
     * @param int $status
     * @return bool
     */
    public function updateCartStatus(int $id, int $status): bool
    {
        $query = "UPDATE " . $this->table . " SET status = :status WHERE id_rent_cart = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":status", $status);

        return $stmt->execute();
    }

    /**
     * get user cart by id_rent_cart
     * @param int $idCart
     * @return array
     */
    public function getUserCartById(int $idCart): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_rent_cart = :id_rent_cart";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_rent_cart" => $idCart
        );

        $stmt->execute($data);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * updateCartRelayPoint
     * @param int $id
     * @param int $idRelayPoint
     * @return bool
     */
    public function updateCartRelayPoint(int $id, int $idRelayPoint): bool
    {
        $query = "UPDATE " . $this->table . " SET id_location = :idRelayPoint WHERE id_rent_cart = :id";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":idRelayPoint", $idRelayPoint);

        return $stmt->execute();
    }

}