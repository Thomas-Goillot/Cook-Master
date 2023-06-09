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
        $query = "SELECT contains.id_equipment, quantity,name,image,stock,price_purchase,allow_purchase,description FROM contains,equipment WHERE id_shopping_cart = :idCart and contains.id_equipment = equipment.id_equipment";

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
     * get user cart by id_cart
     * @param int $idCart
     * @return array
     */
    public function getUserCartById(int $idCart): array
    {
        $query = "SELECT * FROM shopping_cart WHERE id_shopping_cart = :id_shopping_cart";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_shopping_cart" => $idCart
        );

        $stmt->execute($data);

        return $stmt->fetch(PDO::FETCH_ASSOC);
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

    /**
     * delete product from cart
     * @return bool
     */
    public function deleteProductInCart(int $userCartId, int $idProduct): bool
    {
        $query = "DELETE FROM contains WHERE id_equipment = :id_equipment AND id_shopping_cart = :id_shopping_cart";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_equipment" => $idProduct,
            ":id_shopping_cart" => $userCartId
        );

        return $stmt->execute($data);
    }
    
    /**
     * delete cart from user
     * @return bool
     */
    public function deleteCart(int $userCartId): bool
    {
        $query = "DELETE FROM shopping_cart WHERE id_shopping_cart = :id_shopping_cart";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_shopping_cart" => $userCartId
        );

        return $stmt->execute($data);
    }


    /**
     * updateCartRelayPoint
     */
    public function updateCartRelayPoint(int $userCartId, int $idRelayPoint): bool
    {
        $query = "UPDATE shopping_cart SET id_location = :id_location, id_shipping_address = NULL WHERE id_shopping_cart = :id_shopping_cart";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_location" => $idRelayPoint,
            ":id_shopping_cart" => $userCartId
        );

        return $stmt->execute($data);
    }

    /**
     * addCartAddress
     */
    public function addCartAddress(int $idShoppingCart, int $userId, string $name, string $address, string $city, int $zipCode, string $country): bool
    {
        $query = "INSERT INTO shipping_address SET name = :name, address = :address, city = :city, zip_code = :zip_code, country = :country, id_users = :id_users";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":name" => $name,
            ":address" => $address,
            ":city" => $city,
            ":zip_code" => $zipCode,
            ":country" => $country,
            ":id_users" => $userId
        );

        $stmt->execute($data);

        $lastId = $this->_connexion->lastInsertId();

        $query = "UPDATE shopping_cart SET id_shipping_address = :id_shipping_address, id_location = NULL WHERE id_users = :id_users AND id_command_status = " . CART_PROGRESS;

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_shipping_address" => $lastId,
            ":id_users" => $userId
        );

        return $stmt->execute($data);
    }

    /**
     * updateCartAddress
     */
    public function updateCartAddress(int $idShoppingCart, int $userId, int $userShippingAddress, string $name, string $address, string $city, int $zipCode, string $country): bool
    {
        $query = "UPDATE shipping_address SET name = :name, address = :address, city = :city, zip_code = :zip_code, country = :country WHERE id_shipping_address = :id_shipping_address AND id_users = :id_users";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":name" => $name,
            ":address" => $address,
            ":city" => $city,
            ":zip_code" => $zipCode,
            ":country" => $country,
            ":id_shipping_address" => $userShippingAddress,
            ":id_users" => $userId
        );

        $stmt->execute($data);
        
        $query = "UPDATE shopping_cart SET id_shipping_address = :id_shipping_address, id_location = NULL WHERE id_users = :id_users AND id_command_status = " . CART_PROGRESS;

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_shipping_address" => $userShippingAddress,
            ":id_users" => $userId
        );

        return $stmt->execute($data);
    }

    /**
     * update cart status
     * @param int $idShoppingCart
     * @param int $status
     * @return bool
     */
    public function updateCartStatus(int $idShoppingCart, int $status): bool
    {
        $query = "UPDATE shopping_cart SET id_command_status = :id_command_status WHERE id_shopping_cart = :id_shopping_cart";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_command_status" => $status,
            ":id_shopping_cart" => $idShoppingCart
        );

        return $stmt->execute($data);
    }

    /**
     *  getUserShippingAddress
     * */
    public function getUserShippingAddress(int $userId): array
    {
        $query = "SELECT * FROM shipping_address WHERE id_users = :id_users";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_users" => $userId
        );

        $stmt->execute($data);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getShippingType
     */
    public function getShippingType(int $idShoppingCart): array
    {
        $query = "SELECT id_location, id_shipping_address FROM shopping_cart WHERE id_shopping_cart = :id_shopping_cart";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_shopping_cart" => $idShoppingCart
        );

        $stmt->execute($data);
        
        $data =  $stmt->fetch(PDO::FETCH_ASSOC);

        if($data['id_location'] != NULL){
           return array(
               "type" => RELAY_POINT,
               "id" => $data['id_location']
           );
        }else{
            return array(
                "type" => HOME_DELIVERY,
                "id" => $data['id_shipping_address']
            );
        }
    }

    /**
     * addDatePurchase
     * @param int $idShoppingCart
     * @return bool
     */
    public function addDatePurchase(int $idShoppingCart): bool
    {
        $query = "UPDATE shopping_cart SET date_purchase = NOW() WHERE id_shopping_cart = :id_shopping_cart";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_shopping_cart" => $idShoppingCart
        );

        return $stmt->execute($data);
    }

    /**
     * getAllCommandsValidated
     * @param int $userId
     * @return array
     */
    public function getAllCommandsValidated(int $userId): array
    {
        $query = "SELECT id_shopping_cart, date_purchase, id_command_status FROM shopping_cart WHERE id_users = :id_users AND id_command_status != " . CART_PROGRESS;

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_users" => $userId
        );

        $stmt->execute($data);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * checkVoucherInCart
     * @param int $idShoppingCart
     * @return bool
     */
    public function checkVoucherInCart(int $idShoppingCart): bool
    {
        $query = "SELECT id_voucher FROM shopping_cart WHERE id_shopping_cart = :id_shopping_cart";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_shopping_cart" => $idShoppingCart
        );

        $stmt->execute($data);

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if($res['id_voucher'] != NULL){
            return true;
        }else{
            return false;
        }
    }

    /**
     * addVoucherToCart
     * @param int $idShoppingCart
     * @param int $idVoucher
     * @return bool
     */
    public function addVoucherToCart(int $idShoppingCart, int $idVoucher): bool
    {
        $query = "UPDATE shopping_cart SET id_voucher = :id_voucher WHERE id_shopping_cart = :id_shopping_cart";

        $stmt = $this->_connexion->prepare($query);

        $data = array(
            ":id_voucher" => $idVoucher,
            ":id_shopping_cart" => $idShoppingCart
        );

        return $stmt->execute($data);
    }

}