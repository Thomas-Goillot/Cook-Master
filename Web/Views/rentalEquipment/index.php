<head>
    <link href="<?= $path_prefix ?>assets/css/rentalEquipment/style.css" rel="stylesheet" />
</head>
<?php
include_once('Views/layout/dashboard/path.php');
?>


<div class="row">
    <?php

    foreach ($allProduct as $allProduct) {
        if ($allProduct['allow_rental'] == 0) {
            echo ' <div class="col-lg-4 text-center width="300px">';
            echo ' <div class="card card-animate text-center">';
            echo '<div class="card-header text-center">';
            echo '<h3>' . $allProduct['name'] . '</h3>';
            echo '<h5> Prix unitaire : ' . $allProduct['price_rental'] . ' €  </h5>';
            echo '<p> Nombre disponible :' . $allProduct['stock'] . '</p>';
            echo '</div>';
            echo '<div class="card-body d-flex flex-column ">';
            echo '<div class="d-flex flex-column">';


            echo '<p text-center><img src="' . $path_prefix  . 'assets/images/productShop/' . $allProduct['image'] . '" width="300px" height="300px"></p>';


            echo '<p class="h3">Disponibilité à la location: <i class="text-success fas fa-check" id="subscriptionOption_pricing2"></i> </p>';

            echo " 
                <div class='smallBtn'>             
                <button type='button' class='btn btn-primary mt-4 mb-2 btn-rounded small' data-toggle='modal' data-target='#equipment" . $allProduct['id_equipment'] . "'>
                    Louer
                </button>
                </div>";

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo " 
                <!-- Modal -->
                <!-- Modal -->
                <div class='modal' id='equipment" . $allProduct['id_equipment'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document '>
                        <div class='modal-content'>
                        <div class='modal-header d-flex flex-column align-items-center'>
                                <h5 class='modal-title' id='label" . $allProduct['id_equipment'] . "'></h5>
                            <h1>" . $allProduct['name'] . "</h1>
                            <img width ='300px' src='" . $path_prefix  . 'assets/images/productShop/' . $allProduct['image'] . "' alt='" . $allProduct['image'] . ">
                            </div>
                            <div class='modal-body'>
                            <h4> Description :</h4>
                            <p class='blockquote text-center'>" . $allProduct['description'] . "</p>
                                                
                        </div>
                            <div class='modal-footer d-flex flex-column'>
                            <p></p>
                            <h4> Il y en a " . $allProduct['stock'] . " de disponibles !</h4>   
                            <div class='form-group d-flex flex-column align-items-center'>
                                <label class='h5'>Date de la location</label>
                                <input type='text' class='form-control date' id='RentDate' name='RentDate' data-toggle='daterangepicker' data-time-picker='true' data-locale='{'format': 'DD/MM/YYYY hh:mm'}>
                            </div>

                                <button type='button'  class='btn btn-secondary mt-4 mb-2 btn-rounded small' data-dismiss='modal'>Annuler</button>
                                <button type='button' class='btn btn-primary mt-4 mb-2 btn-rounded small'>Valider</button>
                            </div>
                        </div>
                    </div>
                </div>";
        }
    }

    ?>
</div>