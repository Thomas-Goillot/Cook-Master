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
    public function getAllRecipesDesserts(): array
    {
        $query = "SELECT * FROM recipes WHERE type = 3";

        $stmt = $this->_connexion->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Add a recipe
     * @param string $name
     * @param int $type
     * @param string $infoRecipe
     * @param string $image
     * @param int $idUser
     * @return int
     */
    public function addRecipe(string $name, int $type, string $infoRecipe, string $image, int $idUser): int{
        $query = "INSERT INTO recipes (name, type, description, image, id_users) VALUES (:name, :type, :description, :image, :id_users)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":description", $infoRecipe);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":id_users", $idUser);

        $stmt->execute();

        return $this->_connexion->lastInsertId();
    }


    //addIngredient($ingredients[$i], $quantities[$i], $idRecipe);
    /**
     * Add an ingredient
     * @param string $name
     * @param string $quantityrecipesuse
     * @param int $idRecipe
     * @return int
     */
    public function addIngredient(string $name, string $quantity, int $idRecipe): int{
        $query = "INSERT INTO ingredient (name) VALUES (:name)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->execute();

        $idIngredient = $this->_connexion->lastInsertId();

        $query = "INSERT INTO used (id_recipes, id_ingredient, quantity) VALUES (:id_recipe, :id_ingredient, :quantity)";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_recipe", $idRecipe);
        $stmt->bindParam(":id_ingredient", $idIngredient);
        $stmt->bindParam(":quantity", $quantity);

        $stmt->execute();

        return $this->_connexion->lastInsertId();
    }
    
    /**
     * Get a recipe to display
     * @param int $id_recipes
     * @return array
     */
    public function getRecipeForDisplay($id_recipes): array
    {
        $query = "SELECT r.id_recipes, r.image, r.name, r.description, r.type, r.price, 
        ( SELECT GROUP_CONCAT(CONCAT(i.name, ': ', u.quantity) SEPARATOR ', ') 
        FROM used u JOIN ingredient i ON u.id_ingredient = i.id_ingredient 
        WHERE u.id_recipes = r.id_recipes ) AS ingredients FROM recipes r 
        WHERE r.id_recipes = :id_recipes";

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(":id_recipes", $id_recipes);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}
    