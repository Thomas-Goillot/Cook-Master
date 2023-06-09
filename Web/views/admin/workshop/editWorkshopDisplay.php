<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-xl-4">
        <div class="card card-animate">
            <div class="card-body">
                <form action="<?= $path_prefix ?>WorkshopAdmin/editWorkshop/<?php echo $allWorkshop['id_workshop']; ?>" method="POST" enctype="multipart/form-data">
                    <?php include_once("views/admin/workshop/form.php"); ?>
                    <div class="d-flex justify-content-center">
                        <div class="col-xl-4">
                            <button type="submit" class="btn b btn-primary btn-block btn-rounded small" data-translation-key="Ajouter"></button>
                        </div>
                    </div>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <h4 data-translation-key="N'oublie pas de réserver les matériaux nécessaires"></h4>
            </div>

        </div>
        <div class="col-xl-8">
            <div class="card card-animate">
                <div class="card-body">
                    <h4 class="card-title" data-translation-key="Liste des lieux"><i class="fas fa-clipboard-list mr-2"></i> </h4>
                    <ul class="list-group">
                        <?php
                        foreach ($locations as $location) {
                            $checked = $location['id_location'] == $allWorkshop['id_location'] ? 'checked' : '';
                            echo '<li class="list-group-item" data-addr="' . $location['address'] . '" >';
                            echo '<div class="form-check">';
                            echo '<input class="form-check-input" type="radio" name="location" value="' . $location['id_location'] . ' " ' . $checked . '>';
                            echo '<label class="form-check-label" for="point-relais-' . $location['id_location'] . '"  >';
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
                    <h4 class="card-title" data-translation-key="Carte des lieux"><i class="fas fa-map-marker-alt mr-2"></i> </h4>
                    <div id="map"></div>
                </div>
            </div>

        </div>
    </div>
</div>




<div class="col-12">
    <div class="card">
        <div class="card-body">
            <table id="datatables" class="table dt-responsive ici2">
                <thead>
                    <tr>
                        <th data-translation-key="Nom"></th>
                        <th data-translation-key="Prix"></th>
                        <th data-translation-key="Disponibilité">:</th>
                        <th data-translation-key="Description"></th>
                        <th data-translation-key="Quantité souhaitée"></th>
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
                            echo "<td><input type='number' name='nb_stock[]' max='" . $allProduct['stock'] . "' value='" . $stockEquipment[$allProduct['id_equipment']] . "' data-step='1' min='0' class='form-control' data-color='#df3554'></td>";
                            echo "<td><input type='hidden' name='id_equipment[]' value='" . $allProduct['id_equipment'] . "'></td>";
                            echo "</tr>";
                        }
                    };
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</form>


<button type='button' class='btn b btn-primary btn-rounded' data-toggle='modal' data-target='#workshop' data-translation-key="Suprimmer"></button>

<div class='modal' id='workshop' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>


            <div class='modal-header d-flex flex-column align-items-center text-center'>

                <h1 class='delete'>Attention, toute supression est définitive.</h1>
                <h4>Voulez vous vraiment supprimer l'atelier <?php echo $allWorkshop['name'] ?> ?</h4>
            </div>

            <div class='modal-footer d-flex flex-column'>
                <form action='<?= $path_prefix ?>WorkshopAdmin/deleteWorkshop/<?php echo $allWorkshop['id_workshop']; ?>' command method='POST' enctype='multipart/form-data' class='d-flex flex-column align-items-center'>
                    <button type='submit' class='btn btn-primary mt-4 mb-2 btn-rounded small' data-translation-key="Confirmer"></button>
                    <button type='button' class='btn btn-secondary mt-4 mb-2 btn-rounded small' data-dismiss='modal' data-translation-key="Annuler"></button>
                </form>
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