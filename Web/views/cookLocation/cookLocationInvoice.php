
<div class="row">
  <div class="col-12">
    <div class="card card-animate">
      <div class="card-body">
        <h1>Récapitulatif de la location de cuisine</h1>

        <div class="row">
          <div class="col-md-6">
            <h5>Lieux :</h5>
            <p><?php echo $location['name']?></p>
            <h5>Adresse :</h5>
            <p><?php echo $location['address']?></p>
            <h5>Date de la location :</h5>
            <p>Du <?php echo $start_rental?> au <?php echo $end_rental?></p>
            <h5>Nombre de jours :</h5>
            <p><?php echo $numberOfDays?> jours</p>
            <h5>Prix par <?php echo $typeDay?> :</h5>
            <p><?php echo $price?> €</p>
            <h5>Prix Total :</h5> 
            <p><?php echo $totalPrice?> €</p>
            <form action="<?php echo $path_prefix?>cookLocation/pay/<?php echo $location['id_location'] ?>" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <div class="d-flex justify-content-center align-items-center">
              <button type="submit" class="btn btn-primary btn-block w-25">Procéder au paiement</button>
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


