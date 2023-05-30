<head>
  <link href="<?= $path_prefix ?>assets/css/recipes/styles1.css" rel="stylesheet" />
</head>
<?php
include_once('views/layout/dashboard/path.php');
?>


<?php
echo '  <div class="col-12 margin">
            <div class="position-relative">
                <img src="' . $path_prefix  . 'assets/images/recipes/' . $recipes[0]['image'] . '" class="img-thumbnail">
                <div class="overlay"></div>
                <div class="caption">
                <h1 class="text-white">' . $recipes[0]['name'] . '</h1>
                </div>
            </div>
    </div>

    <div class="col-12 event-details">
    
    <div class="row">

      <div class="col-md-6 col-lg-4">
        <div class="event-details-item">
          <h3>Ingrédients</h3>';
            foreach($ingredientsArray as $ingredient){
              echo '<p class="event-date">' . $ingredient . '</p>';
            }
  echo '</div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="event-details-item">
          <h3>Prix</h3>
          <p class="event-price">' . $recipes[0]["price"] . '€</p>
        </div>
      </div>

    </div>

    <div class="row">
      <div class="col-12">
        <div class="event-details-item">
          <h3>Recette</h3>';
          foreach($StepsArray as $steps){
            echo '<p class="event-description">' . $steps . '</p>';
          }
          
  echo' </div>
      </div>
    </div>
 ';
?>