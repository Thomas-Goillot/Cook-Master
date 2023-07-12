<?php
include_once('views/layout/dashboard/path.php');
?>

<?php
echo '  
<div class="row">
  <div class="col-12">
    <div class="card card-animate">
      <div class="card-body">
        <div class="position-relative">
            <img src="' . $path_prefix  . 'assets/images/event/' . $event['image'] . '" class="img-thumbnail">
            <div class="overlay"></div>
            <div class="caption">
            <h1 class="text-white">' . $event['name'] . '</h1>
            <h4 class="text-white">' . $event['slug'] . '</h4>
            </div>
        </div>

        <div class="row mt-3">

          <div class="col-md-6 col-lg-4">
            <div class="event-details-item">
              <h3>Date</h3>
              <p class="event-date">' . $event['date_start'] . ' - ' . $event['date_end'] . '</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="event-details-item">
              <h3>Nombre de places</h3>
              <p class="event-place">' . $nbPlace . '</p>
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

        <h3>Nombre de place à réserver :</h3>
        <div class="row">
          <div class="col-xl-4">
            <form action="' . $path_prefix . 'Events/pay/' . $event['id_event'] . '" method="POST">
              <div class="d-flex align-items-center justify-content-center">
                <input type="number" data-toggle="touchspin" data-step="1" data-decimals="0" name="place" min="1"  max="' . $nbPlace . '" required="" class="form-control" value="1">
                <button type="submit" class="btn btn-primary btn-rounded small" data-toggle="modal">Réserver</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>';

?>

<div class="row">

  <div class="col-xl-8">
    <div class="card card-animate">
      <div class="card-body">
        <div class="d-flex justify-content-center flex-column ">
          <h2>Les avis pour l'évenement <?php echo $event['name'] ?></h2>
          <div style="overflow-y: scroll; height: 40vh;">
            <?php
            foreach ($getAllCommentById as $comment) {
              echo '<div class="card-body">
                      <div class="media">
                        <div class="media-body">
                          <h5 class="mt-0">Utilisateur : ' . $comment['name'] . '</h5>
                          <p>Note : ';
              include('rating.php');
              echo '</p>
                          <p>' . $comment['content'] . '</p>
                        </div>
                      </div>
                    </div>';
            };
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="col-xl-4">
    <div class="card card-animate">
      <div class="card-body">
        <h4 class="card-title">Laissez un avis ?</h4>
        <form action="../../EventsPresentation/addComment/<?php echo $event['id_event'] ?>" method="POST">
          <h5>Note : </h5>
          <div class="card card-animate">
            <div class="btn-group mr-2" role="group" aria-label="First group">
              <button type="button" name="1" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-chef-hat"></i></button>
              <button type="button" name="2" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-chef-hat"></i></button>
              <button type="button" name="3" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-chef-hat"></i></button>
              <button type="button" name="4" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-chef-hat"></i></button>
              <button type="button" name="5" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-chef-hat"></i></button>
            </div>
          </div>

          <input type="hidden" name="rating" id="rating" value="">

          <h5>Votre commentaire : </h5>
          <div class="form-group">
            <textarea class="form-control" name="comment" placeholder="Votre avis nous intéresse !" rows="3"></textarea>
          </div>

          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary btn-rounded small" data-toggle="modal" data-translation-key="Ajouter"></button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>