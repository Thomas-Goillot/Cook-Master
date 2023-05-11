<?php
namespace Models;

use PDO;
use App\Model;
use PDOException;

class Shop extends Model
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
     * Get all products of a cart
     * @return array
     */
    public function getAllProductsOfCart($idCart): array
    {
        $query = "SELECT * FROM contains WHERE id_shopping_cart = :idCart";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":idCart", $idCart);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



     /**
     * get user cart id
     */
    public function getUserCartId(int $id_users)
    {
 
        $query = "SELECT id_shopping_cart FROM ". $this->table ." WHERE id_users = :id_users AND id_command_status = " . CART_PROGRESS;

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_users" => $id_users
        );

        $stmt->execute($data);

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($res) {
            return $res['id_shopping_cart'];
        } else {
            return false;
        }
    }


     /**
     * create cart
     * @return bool
     */
    public function createCart($idUser): bool
    {
        $query = "INSERT INTO shopping_cart (id_users,id_command_status) VALUES (:idUser, :status);";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":idUser" => $idUser,
            ":status" => CART_PROGRESS
        );

        return $stmt->execute($data);
    }

    /**
     * add product to cart
     * @return bool
     */
    public function addProductToCart(int $userCartId, int $idProduct, int $numberOfProduct): bool
    {

        //check if the product is already in the cart
        $query = "SELECT * FROM contains WHERE id_equipment = :id_equipment AND id_shopping_cart = :id_shopping_cart";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_equipment" => $idProduct,
            ":id_shopping_cart" => $userCartId
        );

        $stmt->execute($data);

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($res) {
            //if the product is already in the cart, we update the quantity
            $query = "UPDATE contains SET quantity = quantity + :quantity WHERE id_equipment = :id_equipment AND id_shopping_cart = :id_shopping_cart";

            $stmt = $this->_connexion->prepare($query);

            $data = array(
                ":id_equipment" => $idProduct,
                ":id_shopping_cart" => $userCartId,
                ":quantity" => $numberOfProduct
            );

            return $stmt->execute($data);
        }

        $query = "INSERT INTO contains(id_equipment, id_shopping_cart, quantity) VALUES(:id_equipment, :id_shopping_cart, :quantity)";

        $stmt = $this->_connexion->prepare($query);


        $data = array(
            ":id_equipment" => $idProduct,
            ":id_shopping_cart" => $userCartId,
            ":quantity" => $numberOfProduct            
        );

        return $stmt->execute($data);
    }
    







}