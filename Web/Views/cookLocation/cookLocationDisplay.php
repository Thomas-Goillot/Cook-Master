<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
  <div class="col-12">
    <div class="card card-animate">
      <div class="card-body">
        <div class="position-relative">
          <img src="<?php echo $path_prefix . 'assets/images/location/' . $cookLocations["images"][0]["image"]; ?>" class="img-thumbnail">
          <div class="overlay"></div>
          <div class="caption">
            <h1 class="text-white"><?php echo $cookLocations['name']; ?></h1>
            <h4 class="text-white"><?php echo $cookLocations['address']; ?></h4>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6 col-lg-4">
            <div class="event-details-item">
              <h3>Prix pour la demi-journée</h3>
              <p class="price_half_day"><?php echo $cookLocations['price_half_day']; ?>€</p>
              <h3>Prix pour la journée</h3>
              <p class="price_day"><?php echo $cookLocations['price_day']; ?>€</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="event-details-item">
              <h3>Capacité maximum de personne dans la cuisine :</h3>
              <p class="max_place"><?php echo $cookLocations['max_place']; ?></p>
            </div>
          </div>
        </div>

        <h3>Date de la location :</h3>
        

      </div>
    </div>
  </div>
</div>
