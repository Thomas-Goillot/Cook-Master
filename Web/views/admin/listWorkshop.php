<?php
include_once('views/layout/dashboard/path.php');
?>
<div class="row col-12">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" data-translation-key="Listes de tout les ateliers"></h4>

                <table id="datatables" class="table dt-responsive ici2">
                    <thead>
                        <tr>
                            <th data-translation-key="Nom"></th>
                            <th data-translation-key="Date de début"></th>
                            <th data-translation-key="Date de fin"></th>
                            <th data-translation-key="Prix"></th>
                            <th data-translation-key="Place restante :"></th>
                            <th data-translation-key="Adresse :"></th>
                            <th data-translation-key="Modifier / supprimer"></th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($allWorkshop as $workshop) {
                        echo "<tr>";
                        echo "<td>" . $workshop['name'] . "</td>";
                        echo "<td>" . $workshop['date_start'] . "</td>";
                        echo "<td>" . $workshop['date_end'] . "</td>";
                        echo "<td>" . $workshop['price'] . " €</td>";
                        echo "<td>" . $workshop['nb_place'] . " disponibles</td>";
                        echo "<td>" . $workshop['address'] . "</td>";
                        echo "<td>
                                <a href='" . $path_prefix . "WorkshopAdmin/editWorkshopDisplay/" . $workshop['id_workshop'] . "'><button type='submit' class='btn btn-primary mt-4 mb-2 btn-rounded small' data-translation-key=\"Modifier\"></button></a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>