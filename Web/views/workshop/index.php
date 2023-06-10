<?php
include_once('views/layout/dashboard/path.php');
?>


<div class="row">
  <?php
  if ($allWorkshop == NULL) {
    echo "<h1>Aucun atelier à venir</h1>";
  } else {
    foreach ($allWorkshop as $workshop) {
      echo   '<div class="col-xl-6">
                <div class="card ">
                        <div id="carouselExampleCaption" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <a href="' . $path_prefix . 'WorkshopPresentation/WorkshopDisplay/' . $workshop['id_workshop'] . '" >
                                        <img src="' . $path_prefix  . 'assets/images/workshop/' . $workshop['image'] . '" class="img-thumbnail sombre">
                                        <div class="carousel-caption">
                                            <h3 class="text-white">' . $workshop['name'] . '</h3>
                                            <p>'. $workshop['address'].'</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>';
    }
  }
  ?>
</div>