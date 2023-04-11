<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Products extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "equipment";

        $this->getConnection();
    }

    /**
     * Get all products
     * @return array
     */
    public function getAllProducts(): array
    {
        $query = "SELECT * FROM " . $this->table . "";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Add a product
     * @param string $name
     * @param string $description
     * @param string $image
     * @param int $dispnobilitySale
     * @param int $dispnobilityRental
     * @param int $dispnobilityEvent
     * @param int $dispnobilityStock
     * @param int $id_users
     * @return void
     */
    public function addProduct(string $name, string $description, string $image, int $dispnobilitySale, int $dispnobilityRental, int $dispnobilityEvent, int $dispnobilityStock, int $id_users): void
    {
        $query = "INSERT INTO " . $this->table . "(name,description,image,allow_rental,allow_event,allow_purchase,stock,id_users) VALUES (:name,:description,:image,:dispnobilityRental,:dispnobilityEvent,:dispnobilitySale,:dispnobilityStock,:id_users)";

        $data = array(
            ":name" => $name,
            ":description" => $description,
            ":image" => $image,
            ":dispnobilityRental" => $dispnobilityRental,
            ":dispnobilityEvent" => $dispnobilityEvent,
            ":dispnobilitySale" => $dispnobilitySale,
            ":dispnobilityStock" => $dispnobilityStock,
            ":id_users" => $id_users
        );

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute($data);
    }


}
