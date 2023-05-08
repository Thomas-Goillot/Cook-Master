<?php

namespace Controllers;

use App\Controller;

class Recipes extends Controller{

    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "recipes/index";

    /**
     * Display the recipes page
     * @return void
     */
    public function index(){

        $this->loadModel('Recipes');

        $page_name = array("Recipes" => $this->default_path);

        $getAllRecipesDishes = $this->_model->getAllRecipesDishes();

        $getAllRecipesStarters = $this->_model->getAllRecipesStarters();

        $getAllRecipesDesserts = $this->_model->getAllRecipesDesserts();

        $this->render($this->default_path, compact('page_name', 'getAllRecipesDishes', 'getAllRecipesStarters', 'getAllRecipesDesserts'), NO_LAYOUT);
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

}