<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Join extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "provider";

        $this->getConnection();
    }


    /**
     * Join us
     * @param string $siret
     * @param int $id_users
     * @param string $cv
     * @param string $photo
     * @param string $type
     */
    public function sendRequest(string $siret, int $id_users, string $cv, string $photo, string $type): void
    {
        $query = "INSERT INTO providers (siret, id_users) VALUES (:siret, :id_users)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":siret", $siret);
        $stmt->bindParam(":id_users", $id_users);

        $stmt->execute();

        $idProviders = $this->_connexion->lastInsertId();

        $query = "INSERT INTO providers_files (file) VALUES (:file)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":file", $cv);

        $stmt->execute();

        $idProvidersFile = $this->_connexion->lastInsertId();

        $query = "INSERT INTO add_files (id_providers, id_providers_files) VALUES (:id_providers, :id_providers_files)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_providers", $idProviders);
        $stmt->bindParam(":id_providers_files", $idProvidersFile);

        $stmt->execute();


        $query = "INSERT INTO providers_images (image) VALUES (:image)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":image", $photo);

        $stmt->execute();

        $idProvidersImages = $this->_connexion->lastInsertId();

        $query = "INSERT INTO add_images (id_providers, id_providers_images) VALUES (:id_providers, :id_providers_images)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_providers", $idProviders);
        $stmt->bindParam(":id_providers_images", $idProvidersImages);

        $stmt->execute();

        $query = "INSERT INTO providers_type (type) VALUES (:type)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":type", $type);

        $stmt->execute();

        $idProvidersType = $this->_connexion->lastInsertId();

        $query = "INSERT INTO of_type (id_providers, id_providers_type) VALUES (:id_providers, :id_providers_type)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_providers", $idProviders);
        $stmt->bindParam(":id_providers_type", $idProvidersType);

        $stmt->execute();
        
    }


}