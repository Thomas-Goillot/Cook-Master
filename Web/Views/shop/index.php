<?php
include_once('Views/layout/dashboard/path.php');
?>



<div class="row">
            <?php
            
            foreach ($allProduct as $allProduct) {
                if($allProduct['allow_purchase'] == 0){
                 echo ' <div class="col-lg-4">';
                 echo ' <div class="card card-animate">';

                echo '<div class="card-header">';
                echo '<h3>' . $allProduct['name'] . '</h3>';
                echo '<h5> Prix unitaire : '.$allProduct['price_purchase'].' €  </h5>'; 
                echo '<p> Nombre disponible :' . $allProduct['stock'] . '</p>';
                echo '</div>';

                
                echo '<p class="h5">' .  $allProduct['description'] . '</p>';


                echo '<div class="card-body d-flex flex-column">';
                echo '<div class="d-flex flex-column align-items-baseline">';
                

                echo '<p><img src="' . $path_prefix  . 'assets/images/productShop/' . $allProduct['image'] . '" width="450px"></p>';

     
                
                echo '<p class="h3">Disponibilité à la vente : <i class="text-success fas fa-check" id="subscriptionOption_pricing2"></i></p>';
                echo ' <form  action="' .$path_prefix.'Shop" method="POST" enctype="multipart/form-data">';
                echo ' <input type="number" name="upCart" class="form-control">';
                echo ' <button class="btn btn-primary btn-block" type="submit">Ajouter le produit au panier</button>';
                echo '</form>';


                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                
            }
        }
        
            ?>
        </div>
