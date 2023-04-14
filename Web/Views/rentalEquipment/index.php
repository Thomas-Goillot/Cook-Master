<?php
include_once('Views/layout/dashboard/path.php');
?>


<div class="row">
            <?php
            
            foreach ($allProduct as $allProduct) {
                if($allProduct['allow_rental'] == 0){
                 echo ' <div class="col-lg-4 width="300px">';
                 echo ' <div class="card card-animate">';
                echo '<div class="card-header">';
                echo '<h3>' . $allProduct['name'] . '</h3>';
                echo '<h5> Prix unitaire : '.$allProduct['price_rental'].' €  </h5>'; 
                echo '<p> Nombre disponible :' . $allProduct['stock'] . '</p>';
                echo '</div>';



                echo '<p class="h5">' .  $allProduct['description'] . '</p>';


                echo '<div class="card-body d-flex flex-column">';
                echo '<div class="d-flex flex-column align-items-baseline">';


                echo '<p><img src="' . $path_prefix  . 'assets/images/productShop/' . $allProduct['image'] . '" width="450px"></p>';


                echo '<p class="h3">Disponibilité à la location: <i class="text-success fas fa-check" id="subscriptionOption_pricing2"></i> </p>';

                echo "              
                <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#equipment". $allProduct['id_equipment'] ."'>
                    Launch demo modal
                </button>";


                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';



                echo " 
            
   





                <!-- Modal -->
                <!-- Modal -->
                <div class='modal' id='equipment". $allProduct['id_equipment'] ."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='label". $allProduct['id_equipment'] ."'></h5>
                                
                            </div>
                            <div class='modal-body'>







                                Woohoo, you're reading this text in a modal!










                            </div>
                            <div class='modal-footer'>






                                <button type='button' class='btn btn-secondary waves-effect waves-light' data-dismiss='modal'>Close</button>
                                <button type='button' class='btn btn-primary waves-effect waves-light'>Save changes</button>










                            </div>
                        </div>
                    </div>
                </div>


               
                " ;
                
            }
        }
        
            ?>
        </div>




        