<?php
include_once('views/layout/dashboard/path.php');
?>
<div class="row col-8">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Listes de tout les ateliers</h4>

                <table id="datatables" class="table dt-responsive ici2">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Prix</th>
                            <th>Place restante :</th>
                            <!-- <th>Adresse :</th>   -->
                            <th>Modifier / supprimer</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($allWorkshop as $workshop) {
                    foreach ($location as $location) {
                        echo "<tr>";
                        echo "<td>" . $workshop['name'] . "</td>";
                        echo "<td>" . $workshop['date_start'] . "</td>";
                        echo "<td>" . $workshop['date_end'] . "</td>";
                        echo "<td>" . $workshop['price'] . " €</td>";
                        echo "<td>" . $workshop['nb_place'] . " disponibles</td>";


                        echo "<td>" . $location['location_address'] . "</td>";

                        echo "<td>
            <a href='" . $path_prefix . "WorkshopAdmin/editWorkshopDisplay/" . $workshop['id_workshop'] . "'><button type='submit' class='btn btn-primary mt-4 mb-2 btn-rounded small'>Modifier</button></a>
          </td>";
                        echo "</tr>";
                    }
                }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>