<?php

namespace Models;

use PDO;
use App\Model;
use PDOException;

class Recipes extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->table = "recipes";

        $this->getConnection();
    }

    /**
     * Get all dishes
     *
     * @return array
     */
    public function getAllRecipesDishes(): array
    {
        $query = "SELECT * FROM recipes WHERE type = 2";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all starters
     *
     * @return array
     */
    public function getAllRecipesStarters(): array
    {
        $query = "SELECT * FROM recipes WHERE type = 1";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        /**
     * Get all starters
     *
     * @return array
     */
    public function getAllRecipesDesserts(): array
    {
        $query = "SELECT * FROM recipes WHERE type = 3";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
    