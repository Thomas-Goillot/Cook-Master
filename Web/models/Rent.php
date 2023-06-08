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
        $this->table = "rent_equipment";

        $this->getConnection();
    }




    /**
     * validation rent
     */
    public function verifRent(): array
    {
        $query = "SELECT * FROM  equipment WHERE id_equipment = ? id_equipment";


        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }







    // public function editRent(int $id_users, int $id_equipment): void
    // {
    //     $query = "INSERT INTO". $this->table ."(id_users, id_equipment, start_rental, end_rental)
    //               SELECT :id_users, :id_equipment, NOW(), NOW() 
    //               FROM equipment 
    //               WHERE :id_users = 1";


    //     $stmt = $this->_connexion->prepare($query);


    //     $data = array(
    //         ":id_users" => $id_users,
    //         ":id_equipment" => $id_equipment
    //     );


    //     $stmt = $this->_connexion->prepare($query);

    //     $stmt->execute($data);
    // }
    


}