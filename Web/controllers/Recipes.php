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

}