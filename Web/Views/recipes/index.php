<head>
  <link href="<?= $path_prefix ?>assets/css/recipes/styles.css" rel="stylesheet" />
</head>

<?php
    include_once('views/layout/dashboard/path.php');
?>
<h3>Entrées</h3>
<div class="row">
    <?php
        foreach($getAllRecipesStarters as $info){
             echo   '<div class="col-xl-6">
                        <div class="card ">
                                <div id="carouselExampleCaption" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active">
                                            <a href="'. $path_prefix.'Recipes/RecipeDisplay/'.$info['id_recipes'].'" >
                                                <img src="' . $path_prefix  . 'assets/images/recipes/' . $info['image'] . '" class="img-thumbnail sombre">
                                                <div class="carousel-caption">
                                                    <h3 class="text-white">' . $info['name'] . '</h3>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>';
        }
    ?>
</div>



<h3>Plats</h3>
<div class="row">
    <?php
        foreach($getAllRecipesDishes as $info){
             echo   '<div class="col-xl-6">
                        <div class="card ">
                                <div id="carouselExampleCaption" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active">
                                            <a href="'. $path_prefix.'Recipes/RecipeDisplay/'.$info['id_recipes'].'" >
                                                <img src="' . $path_prefix  . 'assets/images/recipes/' . $info['image'] . '" class="img-thumbnail sombre">
                                                <div class="carousel-caption">
                                                    <h3 class="text-white">' . $info['name'] . '</h3>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>';
        }
    ?>
</div>

<h3>Desserts</h3>
<div class="row">
    <?php
        foreach($getAllRecipesDesserts as $info){
             echo   '<div class="col-xl-6">
                        <div class="card ">
                                <div id="carouselExampleCaption" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active">
                                            <a href="'. $path_prefix.'Recipes/RecipeDisplay/'.$info['id_recipes'].'" >
                                                <img src="' . $path_prefix  . 'assets/images/recipes/' . $info['image'] . '" class="img-thumbnail sombre">
                                                <div class="carousel-caption">
                                                    <h3 class="text-white">' . $info['name'] . '</h3>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>';
        }
    ?>
</div>