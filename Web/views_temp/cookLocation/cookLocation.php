<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
<?php
  if ($cookLocations == NULL) {
    echo "<h1>Aucun atelier à venir</h1>";
  } else {
    foreach ($cookLocations as $cookLocations) {

      echo '<div class="col-xl-6">
              <div class="card">
                <div id="carouselExampleCaption" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                      <a href="' . $path_prefix . 'cookLocation/cookLocationDisplay/' . $cookLocations['id_location'] . '">
                        <img src="' . $path_prefix  . 'assets/images/location/' . $cookLocations["location_info"]["images"][0]["image"] . '" class="img-thumbnail sombre">
                        <div class="carousel-caption">
                          <h3 class="text-white">' . $cookLocations['name'] . '</h3>
                          <p>' . $cookLocations['address'] . '</p>
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
