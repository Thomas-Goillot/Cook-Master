<?php
include_once('views/layout/dashboard/path.php');

?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h2>Points relais</h2>
                <p>Retirez votre commande dans un point relais</p>
                <form method="POST" action="../rentalEquipment/relayPointSave">
                    <ul class="list-group">
                        <?php
                        foreach ($allRelayPoint as $relayPoint) {
                            echo '<li class="list-group-item" data-addr="' . $relayPoint['address'] . '" onclick="locationClick(this, ' . $relayPoint['id_location'] . ');checkRadio(this)">';
                            echo '<div class="form-check">';
                            echo '<input class="form-check-input" type="radio" name="idRelayPoint" value="' . $relayPoint['id_location'] . '">';
                            echo '<label class="form-check-label" for="point-relais-' . $relayPoint['id_location'] . '">';
                            echo $relayPoint['name'] . " - " . $relayPoint['address'];
                            echo '<span class="d-none" id="addr' . $relayPoint['id_location'] . '">' . $relayPoint['address'] . '</span>';
                            echo '</label>';
                            echo '</div>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                    <button type="submit" class="btn btn-primary mt-3">Valider le point relais et payer</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4" id="locationCol"></div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-map-marker-alt mr-2"></i> Carte</h4>
                <div id="map"></div>
            </div>
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