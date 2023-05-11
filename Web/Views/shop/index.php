<head>
    <link href="<?= $path_prefix ?>assets/css/rentalEquipment/style.css" rel="stylesheet" />
</head>
<?php
    include_once('views/layout/dashboard/path.php');
?>


<div class="row">
    <?php

    foreach ($allProduct as $allProduct) {
        if ($allProduct['allow_purchase'] == 0) {
            
            echo ' <div class="col-lg-4 text-center width="300px">';
            echo ' <div class="card card-animate text-center">';

            echo '<div class="card-body d-flex flex-column ">';
            echo '<div class="d-flex flex-column icila">';
            echo '<img src="' . $path_prefix  . 'assets/images/productShop/' . $allProduct['image'] . '" width="300px" height="300px">';
            echo '<h3>' . $allProduct['name'] . '</h3>';
            echo '<h5> Prix unitaire: ' . $allProduct['price_purchase'] . '€</h5>
                    <div class="smallBtn">             
                    <button type="button" class="btn btn-primary mt-4 mb-2 btn-rounded small" data-toggle="modal" data-target="#equipment' . $allProduct['id_equipment'] . '">
                        Description
                    </button>
                    </div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';




            echo " <!-- Modal -->
                <!-- Modal -->
                <div class='modal' id='equipment" . $allProduct['id_equipment'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>


                        <div class='modal-header d-flex flex-column align-items-center'>
                            <h1>" . $allProduct['name'] . "</h1>        
                            
                           
                            </div>

                            <div class='modal-body d-flex flex-column align-items-center'>
                            <img width ='300px' src='" . $path_prefix  . 'assets/images/productShop/' . $allProduct['image'] . "' alt='" . $allProduct['image'] . ">

                            <h4> Description :</h4>
                                <p class='blockquote text-center'>" . $allProduct['description'] . "</p>  
                                <h5> Prix unitaire: " . $allProduct['price_purchase'] . "€</h5>       
                            </div>
                    
                            <div class='d-flex flex-column'>
                            <form action='$path_prefix shop/verifCart' command method='POST' enctype='multipart/form-data' class='d-flex flex-column align-items-center'>
                            <h5>Quantité souhaité :</h5>
                            <input type='hidden' name='idProduct' value='".$allProduct['id_equipment']. "'>
                            <input type='number' data-toggle='touchspin' data-step='1' data-decimals='0' name='numberOfProduct' min='0' required='' class='form-control'>
                                <div class='modal-footer d-flex flex-column'>
                                <button type='submit' class='btn btn-primary mt-4 mb-2 btn-rounded small'>Ajouter</button>
                                <button type='button'  class='btn btn-secondary mt-4 mb-2 btn-rounded small' data-dismiss='modal'>Annuler</button>
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