<head>
  <link href="<?= $path_prefix ?>assets/css/events/styles.css" rel="stylesheet" />
</head>
<?php
include_once('views/layout/dashboard/path.php');
?>


<?php
echo '  <div class="col-12 margin">
            <div class="position-relative">
                <img src="' . $path_prefix  . 'assets/images/events/' . $event['image'] . '" class="img-thumbnail">
                <div class="overlay"></div>
                <div class="caption">
                <h1 class="text-white">' . $event['name'] . '</h1>
                <h4 class="text-white">' . $event['slug'] . '</h4>
                </div>
            </div>
    </div>

    <div class="col-12 event-details">
    
    <div class="row">

      <div class="col-md-6 col-lg-4">
        <div class="event-details-item">
          <h3>Date</h3>
          <p class="event-date">' . $event['date_start'] . ' - ' . $event['date_end'] . '</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="event-details-item">
          <h3>Nombre de places</h3>
          <p class="event-place">' . $event['place'] . '</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="event-details-item">
          <h3>Prix</h3>
          <p class="event-price">' . $event['price'] . '€</p>
        </div>
      </div>

    </div>

    <div class="row">
      <div class="col-12">
        <div class="event-details-item">
          <h3>Description</h3>
          <p class="event-description">' . $event['description'] . '</p>
        </div>
      </div>
    </div>
 ';




echo '
<h3>Nombre de place à réserver :</h3>
<div class="row">
<div class="col-4">
<form action="' . $path_prefix . 'Events/pay/'.$event['id_event'].'" method="POST">
  <div class="d-flex align-items-center justify-content-center">
    <input type="number" data-toggle="touchspin" data-step="1" data-decimals="0" name="place" min="1"  max="' . $event['place'] . '" required="" class="form-control" value="1">
    <button type="submit" class="btn btn-primary btn-rounded small" data-toggle="modal">
    Réserver
  </button>
  </div>
  </form>
</div>
</div>
</div>
';


?>




<!-- <form action="' . $path_prefix . 'Events/reservationEvent" method="POST">
  <div class="d-flex align-items-center justify-content-center">
    <input type="number" data-toggle="touchspin" data-step="1" data-decimals="0" name="place" min="1"  max="' . $event['place'] . '" required="" class="form-control" value="1">
    <button type="submit" class="btn btn-primary btn-rounded small" data-toggle="modal">
    Réserver
  </button>
  </div>
  </form> -->