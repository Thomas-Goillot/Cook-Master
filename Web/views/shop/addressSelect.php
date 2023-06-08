<?php
include_once('views/layout/dashboard/path.php');

?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h2>Points relais</h2>
                <p>Retirez votre colis dans un point relais proche de chez vous</p>
                <form method="POST" action="../shop/relayPointSave">
                    <ul class="list-group">
                        <?php
                        foreach ($allRelayPoint as $relayPoint) {
                            echo '<li class="list-group-item" data-addr="' . $relayPoint['address'] . '">';
                            echo '<div class="form-check">';
                            echo '<input class="form-check-input" type="radio" name="idRelayPoint" value="' . $relayPoint['id_location'] . '">';
                            echo '<label class="form-check-label" for="point-relais-' . $relayPoint['id_location'] . '">';
                            echo $relayPoint['name'] . " - " . $relayPoint['address'];
                            echo '</label>';
                            echo '</div>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                    <button type="submit" class="btn btn-primary mt-3">Valider le point relais</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6" id="domicile">

        <form method="POST" action="../shop/addressSave">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h4 class="card-title m-0 p-0">Livraison à domicile</h4>
                        <select class="form-control form-control-sm w-50" name="userShippingAddress" id="userShippingAddress">
                            <option value="0" selected disabled>Sélectionner une adresse</option>
                            <optgroup label="Mes adresses">
                                <?php
                                foreach ($userShippingAddress as $shippingAddress) {
                                    echo '<option value="' . $shippingAddress['id_shipping_address'] . '" data-name="' . $shippingAddress['name'] . '" data-city="' . $shippingAddress['city'] . '" data-address="' . $shippingAddress['address'] . '" data-country="' . $shippingAddress['country'] . '" data-zipcode="' . $shippingAddress['zip_code'] . '">' . $shippingAddress['name'] . ' - ' . $shippingAddress['address'] . '</option>';
                                }
                                ?>
                            </optgroup>
                            <optgroup label="Autres">
                                <option value="-1">Nouvelle adresse</option>
                            </optgroup>
                        </select>
                    </div>


                    <p>Faites-vous livrer à l'adresse de votre choix</p>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control" name="address" id="address">
                    </div>
                    <div class="form-group">
                        <label for="ville">Ville</label>
                        <input type="text" class="form-control" name="city" id="city">
                    </div>
                    <div class="form-group">
                        <label for="codepostal">Code postal</label>
                        <input type="text" class="form-control" name="zipCode" id="zipCode">
                    </div>
                    <div class="form-group">
                        <label for="codepostal">Pays</label>
                        <input type="text" class="form-control" name="country" id="country">
                    </div>
                    <button type="submit" class="btn btn-primary">Valider l'adresse de livraison</button>
        </form>
    </div>
</div>
</div>

<div class="col-lg-6">
    <div class="card card-animate">
        <div class="card-body">
            <h4 class="card-title"><i class="fas fa-map-marker-alt mr-2"></i> Carte</h4>
            <div id="map"></div>
        </div>
    </div>
</div>

<script>
    var adresses = [
        <?php foreach ($allRelayPoint as $location) {
            echo "\"" . $location['address'] . "\",";
        } ?>
    ];
</script>