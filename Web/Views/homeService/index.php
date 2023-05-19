<?php
    include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-xl-4">
        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-clipboard-list mr-2"></i>Une petite envie à la maison ? 😋</h4>
                <?php
                    echo'<p><strong>Nom : </strong>' . $user['name']. ' ' . $user['surname']. '</p>';
                    echo'<p><strong>Numéro : </strong>' . $user['phone']. '</p>';
                    echo'<p><strong>Adresse : </strong>' . $address . '</p>';
                ?>
                <form action="HomeService/sendRequest" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <p><strong>Prestation recherchée : </strong></p>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="customRadio1">Chef uniquement (400€)</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" value="2">
                            <label class="custom-control-label" for="customRadio2">Chef et serveur (800€)</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <p><strong>Equipement : </strong></p>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio3" name="customRadio1" class="custom-control-input" value="0">
                            <label class="custom-control-label" for="customRadio3">Equipement personnel</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio4" name="customRadio1" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="customRadio4">Kit de cuisine (+50€)</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <p><strong>Nourriture : </strong></p>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio5" name="customRadio2" class="custom-control-input" value="0">
                            <label class="custom-control-label" for="customRadio5">Produits personnels</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio6" name="customRadio2" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="customRadio6">Produits du chef (+50€/couvert)</label>
                        </div>
                        <div id="foodInputs">
                            <div class="form-group">
                                <label>Entrée :</label>
                                <input type="text" class="form-control" maxlength="25" name="entrance" id="entrance" />
                            </div>
                            <div class="form-group">
                                <label>Plat :</label>
                                <input type="text" class="form-control" maxlength="25" name="dish" id="dish" />
                            </div>
                            <div class="form-group">
                                <label>Dessert :</label>
                                <input type="text" class="form-control" maxlength="25" name="dessert" id="dessert" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <p><strong>Couverts : </strong></p>
                        <div class="d-flex justify-content-start">
                            <div class="custom-control custom-radio">
                                <input data-toggle="touchspin" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-primary btn-block w-25">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-map-marker-alt mr-2"></i>Domicile</h4>
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>

<script>
    var foodInputs = document.getElementById('foodInputs');
    var productsChefRadio = document.getElementById('customRadio6');
    var productsPersonalRadio = document.getElementById('customRadio5');

    // Écouteur d'événement pour le radio bouton "Produits du chef"
    productsChefRadio.addEventListener('change', function() {
        if (this.checked) {
            foodInputs.style.display = 'block';
        } else {
            foodInputs.style.display = 'none';
        }
    });

    // Écouteur d'événement pour le radio bouton "Produits personnels"
    productsPersonalRadio.addEventListener('change', function() {
        if (this.checked) {
            foodInputs.style.display = 'none';
        } else {
            foodInputs.style.display = 'block';
        }
    });
</script>

<script>
    var adresses = [
        <?php
            echo "\"" . $address . "\",";
        ?>
    ];
</script>