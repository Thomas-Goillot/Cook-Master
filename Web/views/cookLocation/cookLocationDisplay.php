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
            <h1><?php echo $cookLocations['name']; ?></h1>
            <h4><?php echo $cookLocations['address']; ?></h4>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6 col-lg-4">
            <div class="event-details-item">
              <h3 data-translation-key="Prix pour la demi-journée"></h3>
              <p class="price_half_day"><?php echo $cookLocations['price_half_day']; ?>€</p>
              <h3 data-translation-key="Prix pour la journée"></h3>
              <p class="price_day"><?php echo $cookLocations['price_day']; ?>€</p>
            </div>

            <form action="<?php echo $path_prefix ?>cookLocation/cookLocationInvoice/<?php echo $cookLocations['id_location'] ?>" method="POST" enctype="multipart/form-data">
              <div class="form-group">

                <label data-translation-key="Date de la location"></label>
                <input type="text" class="form-control date" name="date_reservation" id="date_reservation" data-toggle="daterangepicker" data-time-picker="true" data-locale="{'format': 'DD/MM/YYYY'}">

                <label for="exampleFormControlSelect1" data-translation-key="Type de location"></label>
                <select class="form-control" id="exampleFormControlSelect1" name="price">
                  <option value="<?= $cookLocations['price_day'] ?>" name="day" data-translation-key="Journée"></option>
                  <option value="<?= $cookLocations['price_half_day'] ?>" name="half_day" data-translation-key="Demi-journée"></option>
                </select>

                <div class="d-flex justify-content-center align-items-center">
                  <button type="submit" class="btn btn-primary btn-block w-25" data-translation-key="Réserver"></button>
                </div>

              </div>
            </form>

          </div>

          <div class="col-md-6 col-lg-4">
            <?php
            $actualDay = date('l');

            foreach ($days as $day) {
              $isToDay = $day == $actualDay ? "font-weight-bold" : "text-muted";

              echo "<div class=\"row\">";
              echo "<div class=\"col-3\">";
              echo "<p class=\"card-text p-0 m-0 " . $isToDay . "\">" . $day . "</p>";
              echo "</div>";

              echo "<div class=\"col-9\">";


              $temp = array_filter($location['opening_hours'], function ($opening_hour) use ($day) {
                return $opening_hour['opening_day'] == $day;
              });

              if (count($temp) == 0) {
                echo "<p class=\"card-text p-0 m-0" . $isToDay . " text-danger\">Fermé</p>";
              } else {
                foreach ($temp as $opening_hour) {
                  $opening_hour['opening_hours'] = substr($opening_hour['opening_hours'], 0, -3);
                  $opening_hour['closing_hours'] = substr($opening_hour['closing_hours'], 0, -3);
                  echo "<p class=\"card-text p-0 m-0 " . $isToDay . "\">" . $opening_hour['opening_hours'] . " - " . $opening_hour['closing_hours'] . "</p>";
                }
              }

              echo "</div>";

              echo "</div>";
            }
            ?>
          </div>



        </div>

      </div>
    </div>
  </div>
</div>