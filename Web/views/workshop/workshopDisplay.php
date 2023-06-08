<?php
include_once('views/layout/dashboard/path.php');

echo '  
<div class="row mx-0 px-0">
  <div class="col-12">
    <div class="card card-animate">
      <div class="card-body">
        <div class="position-relative">
            <img src="' . $path_prefix  . 'assets/images/workshop/' . $workshop['image'] . '" class="img-thumbnail">
            <div class="overlay"></div>
              <div class="caption">
                <h1 class="mt-3">' . $workshop['name'] . '</h1>
                <p>' . $workshop["address"] . '</p>
              </div>
            </div>
          </div>

        <div class="col-12">
        
          <div class="row mx-0 px-0">
            <div class="col-md-6 col-lg-4">
              <div class="event-details-item">
                <h3>Date</h3>
                <p class="event-date">' . $workshop['date_start'] . ' - ' . $workshop['date_end'] . '</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="event-details-item">
                <h3>Nombre de places</h3>
                <p class="event-place">' . fancyNbPlace($nbPlace) . '</p>
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
              <div class="event-details-item">
                <h3>Prix</h3>
                <p class="event-price">' . $workshop['price'] . '€</p>
              </div>
            </div>
          </div>

          <div class="row mx-0 px-0">
            <div class="col-12">
              <div class="event-details-item">
                <h3>Description</h3>
                <p class="event-description">' . $workshop['description'] . '</p>
              </div>
            </div>
          </div>';

if($nbPlace > 0){
  echo ' <h3>Nombre de place à réserver :</h3>
          <div class="row mx-0 px-0">
            <div class="col-4 mb-3">
              <form action="' . $path_prefix . 'WorkshopPresentation/pay/' . $workshop['id_workshop'] . '" method="POST">
                <div class="d-flex align-items-center justify-content-center">
                  <input type="number" data-toggle="touchspin" data-step="1" data-decimals="0" name="place" min="1"  max="' . $nbPlace . '" required="" class="form-control" value="1">
                  <button type="submit" class="btn btn-primary btn-rounded small" data-toggle="modal">Réserver</button>
                </div>
              </form>
            </div>
          </div>';
}
         
echo ' </div>
        </div>
      </div>
    </div>
  </div>
</div>
';
?>
