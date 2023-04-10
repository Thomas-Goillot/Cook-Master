<?php
include_once('Views/layout/dashboard/path.php');
?>




<div class="col-lg-12">
        <div class="card card-animate">
            <?php
            foreach ($allProduct as $allProduct) {
                echo '<div class="d-flex justify-content-between card-header">';
                echo '<h3>' . $allProduct['name'] . '</h3>';
                echo '<p> Nombre disponible :' . $allProduct['stock'] . ' </p>';
                echo '</div>';
                echo '<p>' .  $allProduct['description'] . '</p>';
                echo '<div class="card-body">';
                echo '<p><img src="' . $path_prefix  . 'assets/images/productShop/' . $allProduct['image'] . '" width="500px"></p>';
                echo '<div class="d-flex justify-content-between">';
                if ($allProduct['allow_rental'] == 0) {
                    echo '<p>Disponibilité à la location: <i class="text-success fas fa-check" id="subscriptionOption_pricing2"></i> </p>';
                } else {
                    echo '<p>Disponibilité à la location : <i class="text-danger fas fa-times" id="subscriptionOption_pricing4"></i></p>';
                }
                if ($allProduct['allow_purchase'] == 0) {
                    echo '<p>Disponibilité à la vente : <i class="text-success fas fa-check" id="subscriptionOption_pricing2"></i></p>';
                } else {
                    echo '<p>Disponibilité à la vente : <i class="text-danger fas fa-times" id="subscriptionOption_pricing4"></i></p>';
                }
                if ($allProduct['allow_event'] == 0) {
                    echo '<p>Évenement : <i class="text-success fas fa-check" id="subscriptionOption_pricing2"></i></p>';
                } else {
                    echo '<p>Évenement : <i class="text-danger fas fa-times" id="subscriptionOption_pricing4"></i></p>';
                }
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div> 
