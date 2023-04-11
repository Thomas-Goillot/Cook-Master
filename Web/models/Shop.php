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

    // public function updateStock(int $newStock, int $idEquipment){

    // $query = "UPDATE ".  $this->table ." SET stock = :dispnobilityStock WHERE id = :id_Equipment";



    // $data = array(
    //     ":dispnobilityStock" => $newStock,
    //     ":id_Equipment" => $idEquipment

    // );



    // $stmt = $this->_connexion->prepare($query);

    // $stmt->execute($data);

    // }






}