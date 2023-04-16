<head>
    <link href="<?= $path_prefix ?>assets/css/rentalEquipment/style.css" rel="stylesheet" />
</head>
<?php
    include_once('Views/layout/dashboard/path.php');
?>


<div class="row">
    <div class="col-12">
         <div class="card ">
            <div class="card-body">
                <h4 class="card-title">Boutique</h4>
                <table id="datatable" class="table dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($allProduct as $allProduct) {
                            if($allProduct['allow_purchase'] == 0){
                            echo'<tr>
                                    <td class="tableau1"><img src="' . $path_prefix  . 'assets/images/productShop/' . $allProduct['image'] . '" class="img-fluid tableimg"></td>
                                    <td class="tableau">' . $allProduct['name'] . '</td>
                                    <td class="tableau">'.$allProduct['price_purchase'].'€</td>
                                    <td class="tableau2">
                                        <div class="smallBtn">             
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#equipment'. $allProduct['id_equipment'] .'">
                                            Descritpion
                                        </button>
                                        </div>
                                    </td>
                                </tr>';

                                echo "
                                <div class='modal' id='equipment". $allProduct['id_equipment'] ."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header d-flex flex-column align-items-center'>
                                                <h1>".$allProduct['name']."</h1>
                                            </div>
                                            <div class='modal-body d-flex flex-column'>
                                                <img class='img-fluid tableimg' src='". $path_prefix  . 'assets/images/productShop/'. $allProduct['image'] ."' alt='". $allProduct['image']."> 
                                                <p class='blockquote text-center'>".$allProduct['description']."</p>                    
                                            </div>
                                            <div class='modal-footer d-flex flex-row'>    
                                                <button type='button'  class='btn btn-secondary' data-dismiss='modal'>Annuler</button>
                                                <button type='button' class='btn btn-primary'>Ajouter au panier </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->
