<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-xl-4">
        <div class="card card-animate">
            <div class="card-body">
                <form action="<?= $path_prefix ?>WorkshopAdmin/addWorkshop" method="POST" enctype="multipart/form-data">
                    <?php include_once("views/admin/workshop/form.php"); ?>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <h4 data-translation-key="ReserverMateriaux"></h4>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-clipboard-list mr-2"></i> <span data-translation-key="ListeLieux"></span></h4>
                <ul class="list-group">
                    <?php
                    foreach ($locations as $location) {
                        echo '<li class="list-group-item" data-addr="' . $location['address'] . '">';
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input" type="radio" name="location" value="' . $location['id_location'] . '">';
                        echo '<label class="form-check-label" for="point-relais-' . $location['id_location'] . '">';
                        echo $location['name'] . " - " . $location['address'];
                        echo '</label>';
                        echo '</div>';
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-map-marker-alt mr-2"></i> <span data-translation-key="CarteLieux"></span></h4>
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatables" class="table dt-responsive ici2">
                    <thead>
                        <tr>
                            <th data-translation-key="Nom"></th>
                            <th data-translation-key="Prix"></th>
                            <th data-translation-key="Disponibilite"></th>
                            <th data-translation-key="Description"></th>
                            <th data-translation-key="QuantiteSouhaitee"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($allProduct as $allProduct) {
                            if ($allProduct['allow_rental'] == 0) {
                                echo "<tr>";
                                echo "<td>" . $allProduct['name'] . "</td>";
                                echo "<td>" . $allProduct['price_rental'] . "€</td>";
                                echo "<td>" . $allProduct['stock'] . "</td>";
                                echo "<td><span class='description'>" . substr($allProduct['description'], 0, 40) . "... </span><a href='#' class='read-more'>[...] </a><span class='full-description' style='display: none;'>" . $allProduct['description'] . "</span></td>";
                                echo "<td><input type='number' name='nb_stock[]' max='" . $allProduct['stock'] . "' data-step='1' value='0' min='0' class='form-control' data-color='#df3554'></td>";
                                echo "<td><input type='hidden' name='id_equipment[]' value='" . $allProduct['id_equipment'] . "'></td>";
                                echo "</tr>";
                            }
                        };
                        ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <div class="col-xl-4">
                        <button type="submit" class="btn b btn-primary btn-block btn-rounded small" data-translation-key="Ajouter"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

</div>

<script>
    var adresses = [
        <?php foreach ($locations as $location) {
            echo "\"" . $location['address'] . "\",";
        } ?>
    ];

    //more text
    var readMoreLinks = document.getElementsByClassName('read-more');
    for (var i = 0; i < readMoreLinks.length; i++) {
        readMoreLinks[i].addEventListener('click', function(event) {
            event.preventDefault();
            var description = this.parentNode.getElementsByClassName('description')[0];
            var fullDescription = this.parentNode.getElementsByClassName('full-description')[0];
            if (description.style.display === 'none') {
                description.style.display = 'inline';
                fullDescription.style.display = 'none';
            } else {
                description.style.display = 'none';
                fullDescription.style.display = 'inline';
            }
        });
        readMoreLinks[i].style.color = 'black';
    }
</script>