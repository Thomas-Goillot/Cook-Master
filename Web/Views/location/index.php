<?php
include_once('Views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-lg-8">
        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-clipboard-list mr-2"></i> Liste des lieux</h4>

                <table id="datatable" class="table nowrap">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>adresse</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        foreach ($locations as $location) {
                            echo "<tr class=\"location \" style=\"cursor:pointer;\" data-idLocation=\"" . $location['id_location'] . "\">";
                            echo "<td>" . $location['name'] . "</td>";
                            echo "<td>" . $location['address'] . "</td>";
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



</div>

<script>




</script>