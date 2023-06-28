<div class="row">
  <div class="col-12">
    <div class="card card-animate">
      <div class="card-body">
        <h1 data-translation-key="Récapitulatif de la location de cuisine"></h1>

        <div class="row">
          <div class="col-md-6">
            <h5 data-translation-key="Lieux"> :</h5>
            <p><?php echo $location['name'] ?></p>
            <h5 data-translation-key="Adresse :"></h5>
            <p><?php echo $location['address'] ?></p>
            <h5 data-translation-key="Date de la location"></h5>
            <p><span data-translation-key="Du"></span> <?php echo $start_rental ?> <span data-translation-key="Au"></span> <?php echo $end_rental ?></p>
            <h5 data-translation-key="Nombre de jours"></h5>
            <p><?php echo $numberOfDays ?> <span data-translation-key="jours"></span></p>
            <h5><span data-translation-key="Prix par"></span> <?php echo $typeDay ?> :</h5>
            <p><?php echo $price ?> €</p>
            <h5 data-translation-key="Prix Total :"></h5>
            <p><?php echo $totalPrice ?> €</p>
            <form action="<?php echo $path_prefix ?>cookLocation/pay/<?php echo $location['id_location'] ?>" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <div class="d-flex justify-content-center align-items-center">
                  <button type="submit" class="btn btn-primary btn-block w-25" data-translation-key="Procéder au paiement"></button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-6">
            <img src="<?php echo $path_prefix . 'assets/images/location/' . $location["images"][0]["image"]; ?>" class="img-thumbnail" width="700px">
          </div>
        </div>


      </div>
    </div>
  </div>
</div>