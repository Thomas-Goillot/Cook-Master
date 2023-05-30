<head>
    <link href="<?= $path_prefix ?>assets/css/rentalEquipment/style.css" rel="stylesheet" />
</head>
<?php
include_once('views/layout/dashboard/path.php');
?>


<div class="row">
    <?php

    foreach ($allProduct as $allProduct) {
        if ($allProduct['allow_rental'] == 0) {
            
            echo ' <div class="col-lg-4 text-center width="300px">';
            echo ' <div class="card card-animate text-center">';

            echo '<div class="card-body d-flex flex-column ">';
            echo '<div class="d-flex flex-column icila">';
            echo '<img src="' . $path_prefix  . 'assets/images/productShop/' . $allProduct['image'] . '" width="300px" height="300px">';
            echo '<h3>' . $allProduct['name'] . '</h3>';
            echo '<h5> Prix unitaire: ' . $allProduct['price_rental'] . '€</h5>
                    <div class="smallBtn">             
                    <button type="button" class="btn btn-primary mt-4 mb-2 btn-rounded small" data-toggle="modal" data-target="#equipment' . $allProduct['id_equipment'] . '">
                        Description
                    </button>
                    </div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo "<div class='modal' id='equipment" . $allProduct['id_equipment'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
    
                    <!-- Header -->
                    <div class='modal-header d-flex flex-column align-items-center'>
                        <h1>" . $allProduct['name'] . "</h1>
                    </div>
    
                    <!-- Body -->
                    <div class='modal-body d-flex flex-column align-items-center'>
                        <img width='300px' src='" . $path_prefix . "assets/images/productShop/" . $allProduct['image'] . "' alt='" . $allProduct['image'] . "'>
    
                        <h4> Description :</h4>
                        <p class='blockquote text-center'>" . $allProduct['description'] . "</p>
                        <h4> Prix : " . $allProduct['price_rental'] . "€</h4>
                    </div>
    
                    <!-- Footer -->
                    <div class='modal-footer d-flex flex-column align-items-center'>
                        <form action='" . $path_prefix . "shop/addProductToCart' command method='POST' enctype='multipart/form-data' class='d-flex flex-column align-items-center'>
                            <h5 class='mb-3'>Quantité souhaitée :</h5>
                            <input type='hidden' name='idProduct' value='" . $allProduct['id_equipment'] . "'>
                            <div class='input-group'>
                                <input type='number' data-toggle='touchspin' data-step='1' data-decimals='0' name='numberOfProduct' min='0' required='' class='form-control'>
                            </div>
                            <div class='mt-3'>
                                <button type='button' class='btn btn-secondary mr-2' data-dismiss='modal'>Annuler</button>
                                <button type='submit' class='btn btn-primary'>Ajouter</button>
                            </div>
                        </form>
                    </div>
    
                </div>
            </div>
        </div>";
        }
    }
    ?>
</div>