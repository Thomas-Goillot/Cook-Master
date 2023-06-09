<?php
include_once('views/layout/dashboard/path.php');
?>
<script>
    var macarte = null;
</script>
<div class="row">
    <div class="col-lg-8">
        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-clipboard-list mr-2"></i> Liste des lieux</h4>

                <table id="datatable" class="table nowrap" data-page-length="3">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>adresse</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        foreach ($locations as $location) {
                            echo "<tr class=\"location\" style=\"cursor:pointer;\" data-idLocation=\"" . $location['id_location'] . "\" onclick=\"locationClick(this, " . $location['id_location'] . ")\">";
                            echo "<td>" . $location['name'] . "</td>";
                            echo "<td id='addr" . $location['id_location'] . "'>" . $location['address'] . "</td>";
                            echo "</tr>";
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="col-lg-4" id="locationCol">
    </div>

    <div class="col-lg-8">
        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-map-marker-alt mr-2"></i> Carte des lieux</h4>
                <div id="map"></div>
            </div>
        </div>
    </div>

</div>


<script>
    var adresses = [
        <?php foreach ($locations as $location) {
            echo "\"" . $location['address'] . "\",";
        } ?>
    ];
</script>