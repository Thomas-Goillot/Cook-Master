<head>
  <link href="<?= $path_prefix ?>assets/css/recipes/styles.css" rel="stylesheet" />
</head>

<?php
    include_once('views/layout/dashboard/path.php');
?>
<h5>Entrées</h5>
<div class="row">
    <?php
        foreach($getAllRecipesStarters as $info){
             echo   '<div class="col-xs-6">
                        <div class="card ">
                                <div id="carouselExampleCaption" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active">
                                            <a href="'. $path_prefix.'EventsPresentation/EventDisplay/'.$info['id_recipes'].'" >
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



<h5>Plats</h5>
<div class="row">
    <?php
        foreach($getAllRecipesDishes as $info){
             echo   '<div class="col-xs-6">
                        <div class="card ">
                                <div id="carouselExampleCaption" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active">
                                            <a href="'. $path_prefix.'EventsPresentation/EventDisplay/'.$info['id_recipes'].'" >
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

<h5>Desserts</h5>
<div class="row">
    <?php
        foreach($getAllRecipesDesserts as $info){
             echo   '<div class="col-xs-6">
                        <div class="card ">
                                <div id="carouselExampleCaption" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active">
                                            <a href="'. $path_prefix.'EventsPresentation/EventDisplay/'.$info['id_recipes'].'" >
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