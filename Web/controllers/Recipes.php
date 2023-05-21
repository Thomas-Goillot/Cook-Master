<?php

namespace Controllers;

use App\Controller;

class Recipes extends Controller{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "recipes/index";

    public function __construct()
    {

        if ($this->isLogged() === false) {
            $this->redirect('../home');
            exit();
        }

        if ($this->isAdmin($this->getUserId()) === false) {
            $this->redirect('../home');
            exit();
        }
    }

    /**
     * Display the recipes page
     * @return void
     */
    public function index(){

        $this->loadModel('Recipes');

        $page_name = array("Recettes" => "recipes/index");

        $getAllRecipesDishes = $this->_model->getAllRecipesDishes();

        $getAllRecipesStarters = $this->_model->getAllRecipesStarters();

        $getAllRecipesDesserts = $this->_model->getAllRecipesDesserts();

        $this->render("recipes/index", compact('getAllRecipesDishes','getAllRecipesStarters','getAllRecipesDesserts','page_name'), DASHBOARD);
    }
    
    public function searchIngredient(){

        if (isset($_POST['ingredient'])) {
                
            $curl = curl_init('https://api.spoonacular.com/food/ingredients/search?apiKey=7c54efd616d54ef88364d744339b3601&query='. $_POST['ingredient'].'&number=2&sort=calories&sortDirection=desc');

            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "Accept: application/json"
                ]
            ]);
            
            $data = curl_exec($curl);


            if ($data === false) {
                 dump($data);
                echo "Erreur : " . curl_error($curl);
            } else {
               
                if (curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200) {
                    $data = json_decode($data, true);
                    
                    // $this->setError('ERREUR', "Une erreur est survenue", SUCCESS_ALERT);
                    $this->redirect("../admin/recipesAdmin",["result" => "pouet"]);
                } else {
                    // $this->setError('ERREUR', "Une erreur est survenue", ERROR_ALERT);
                    // $this->redirect("../admin/recipesAdmin");
                };
            };
            
            curl_close($curl);
           

            
        }
    }

    /** 
     * Display the recipes page 
     * @return void
     */
    public function recipesAdmin(): void
    {
        $page_name = array("Admin" => $this->default_path, "Recettes" => "admin/recipesAdmin");

        $this->setJsFile(['recipesAdmin.js']);

        $this->setCssFile(['css/recipesAdmin/recipesAdmin.css']);

        $this->render('admin/recipesAdmin', compact('page_name'), DASHBOARD);
    }

    /**
     * Add a recipe
     * @return void
     */
    public function addRecipe(): void
    {

        $defaultFallback = "../Recipes/recipesAdmin";
        //nameRecipe typeRecipe infoRecipe ingredients[] quantities[] 
        if(!isset($_POST['nameRecipe']) && !isset($_POST['typeRecipe']) && !isset($_POST['infoRecipe']) && !isset($_POST['ingredients']) && !isset($_POST['quantities'])){
            $this->setError('ERREUR', "Tout les champs doivent être remplis", ERROR_ALERT);
            $this->redirect($defaultFallback);
        }

        $nameRecipe = htmlspecialchars($_POST['nameRecipe']);
        $typeRecipe = htmlspecialchars($_POST['typeRecipe']);
        $infoRecipe = htmlspecialchars($_POST['infoRecipe']);
        $ingredients = $_POST['ingredients'];
        $quantities = $_POST['quantities'];

        if(empty($nameRecipe) || empty($typeRecipe) || empty($infoRecipe) || empty($ingredients) || empty($quantities)){
            $this->setError('ERREUR', "Tout les champs doivent être remplis", ERROR_ALERT);
            $this->redirect($defaultFallback);
        }

        //handle image
        if(!isset($_FILES['imageRecipe'])){
            $this->setError('ERREUR', "Vous devez ajouter une image", ERROR_ALERT);
            $this->redirect($defaultFallback);
        }
        
        $acceptable = array('image/jpeg', 'image/png');
        $image = $_FILES['imageRecipe']['type'];

        if (!in_array($image, $acceptable)) {
            $this->setError('Type de fichier non autorisée', "Les type de fichier autorisé sont :  .png et .jpeg", ERROR_ALERT);
            $this->redirect($defaultFallback);
        }

        $maxSize = 5 * 1024 * 1024; //5 Mo
        if ($_FILES['imageRecipe']['size'] > $maxSize) {
            $this->setError('Fichier trop lourd', "la taille du fichier ne doit pas dépasser 5 Mo", ERROR_ALERT);
            $this->redirect($defaultFallback);
        }

        //Si le dossier uploads n'existe pas, le créer
        $path = 'assets/images/recipes';
        if (!file_exists($path)) {
            mkdir($path);
        }

        $filename = $_FILES['imageRecipe']['name'];

        $array = explode('.', $filename);
        $extension = end($array);

        $filename = 'image-' . time() . '.' . $extension;

        $destination = $path . '/' . $filename;

        move_uploaded_file($_FILES['imageRecipe']['tmp_name'], $destination);
    

        $this->loadModel('Recipes');

        $idRecipe = $this->_model->addRecipe($nameRecipe, $typeRecipe, $infoRecipe, $filename, $this->getUserId());

        if($idRecipe === false){
            $this->setError('ERREUR', "Une erreur est survenue lors de l\'ajout de la recette", ERROR_ALERT);
            $this->redirect($defaultFallback);
        }

        for ($i=0; $i < count($ingredients); $i++) { 
            $this->_model->addIngredient($ingredients[$i], $quantities[$i], $idRecipe);
        }

        $this->setError('SUCCES', "La recette a bien été ajoutée", SUCCESS_ALERT);
        $this->redirect($defaultFallback);
    }

    /**
     * display recipe page
     * @return void
     */
    public function RecipeDisplay(): void
    {
        $params = $_GET['params'];

        if (count($params) === 0 || is_numeric($params[0]) === false) {
            $this->redirect('../home');
            exit();
        }

        $id_recipes = (int) $params[0];

        $this->loadModel('Recipes');

        $recipes = $this->_model->getRecipeForDisplay($id_recipes);

        $ingredientsString = $recipes[0]["ingredients"]; // Récupérer la chaîne d'ingrédients

        $ingredientsArray = explode(', ', $ingredientsString);

        $StepsString = $recipes[0]["description"]; // Récupérer les étapes de la recette

        $StepsArray = explode('ÉTAPE ', $StepsString);

        $page_name = array($recipes[0]['name']=> $this->default_path, $recipes[0]['name'] => "RecipeDisplay/$id_recipes");

        $this->render('recipes/recipe', compact('page_name', 'recipes', 'ingredientsArray', 'StepsArray'), DASHBOARD, '../../');
    }

}