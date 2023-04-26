<head>
    <link href="<?= $path_prefix ?>assets/css/products/products.css" rel="stylesheet" />
</head>
<?php
include_once('Views/layout/dashboard/path.php');
?>
<div class="row">
    <div class="col-lg-4">
        <div class="card card-animate">
            <div class="card-body">
                <form action="<?= $path_prefix ?>admin/addProduct" method="POST" enctype="multipart/form-data">
                    <?php include_once('Views/shop/form.php'); ?>
                </form>
            </div>
        </div>


        <div class="row col-8">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Listes de tout les produits</h4>

                        <table id="datatables" class="table dt-responsive ici2">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Date de création</th>
                                    <th>Prix location</th>
                                    <th>Prix à l'achat</th>
                                    <th>Stock</th>
                                    <th>Disponibilité:</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($allProduct as $allProduct) {
                                    echo "<tr>
                                            <td>" . $allProduct['name'] . "</td>
                                            <td>" . $allProduct['creation_date'] . "</td>";

                                    if ($allProduct['price_rental'] == 0) {
                                        echo "<td> Non disponible à la location</td>";
                                    } else {
                                        echo "<td>" . $allProduct['price_rental'] . "€</td>";
                                    }
                                    if ($allProduct['price_purchase'] == 0) {
                                        echo "<td> Non disponible à la vente</td>";
                                    } else {
                                        echo "<td>" . $allProduct['price_purchase'] . "€</td>";
                                    }
                                    echo "
                                            <td>" . $allProduct['stock'] . "</td>

                                            
                                            <td>";
                                    if ($allProduct['allow_rental'] == 0) {
                                        echo '<div class="stretch"><span class="mx">Location: <i class="text-success fas fa-check" id="subscriptionOption_pricing2"></i></span>';
                                    } else {
                                        echo '<div class="stretch"><span class="mx">Location: <i class="text-danger fas fa-times" id="subscriptionOption_pricing4"></i></span>';
                                    }
                                    if ($allProduct['allow_purchase'] == 0) {
                                        echo '<span class="mx">Vente: <i class="text-success fas fa-check" id="subscriptionOption_pricing2"></i></span>';
                                    } else {
                                        echo '<span class="mx">Vente: <i class="text-danger fas fa-times" id="subscriptionOption_pricing4"></i></span>';
                                    }
                                    if ($allProduct['allow_event'] == 0) {
                                        echo '<span class="mx">Évenement: <i class="text-success fas fa-check" id="subscriptionOption_pricing2"></i></span></div>';
                                    } else {
                                        echo '<span class="mx">Évenement: <i class="text-danger fas fa-times" id="subscriptionOption_pricing4"></i></span>';
                                    }
                                    echo "
                                    </td>

                                    <td>                  
                                    <a href='" . $path_prefix . "admin/editProductDisplay/" . $allProduct['id_equipment'] . "'><button type='submit' class='btn btn-primary mt-4 mb-2 btn-rounded small'>Modifier</button></a>
                                    </td>
                                    <td>                  
                                    <button type='button' class='btn btn-primary mt-4 mb-2 btn-rounded small' data-toggle='modal' data-target='#equipment" . $allProduct['id_equipment'] . "'>Suprimmer </button>
                                    </td>


                                    </tr>";





                                    echo "<!-- Modal -->
                <div class='modal' id='equipment" . $allProduct['id_equipment'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>


                        <div class='modal-header d-flex flex-column align-items-center text-center'>
                                
                            <h1 class='delete'>Attention, toute supression est définitive.</h1>
                            <h4>" . $allProduct['name'] . "</h4>       
                            
                           
                            </div>

                            <div class='modal-body d-flex flex-column align-items-center'>
                            <img width ='300px' src='" . $path_prefix  . 'assets/images/productShop/' . $allProduct['image'] . "' alt='" . $allProduct['image'] . ">

                            <h4> Description :</h4>
                                <p class='blockquote text-center'>" . $allProduct['description'] . "</p>  
                                <h5> Prix unitaire: " . $allProduct['price_purchase'] . "€</h5>        
                            </div>
                    
                            <div class='modal-footer d-flex flex-column'>
                            <form action='$path_prefix admin/deleteProduct' command method='POST' enctype='multipart/form-data' class='d-flex flex-column align-items-center'>
                                <button type='submit' class='btn btn-primary mt-4 mb-2 btn-rounded small'>Confirmer</button>
                                <button type='button'  class='btn btn-secondary mt-4 mb-2 btn-rounded small' data-dismiss='modal'>Annuler</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>";
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>