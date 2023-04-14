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
                    <div class="form-group">
                        <label">Nom</label>
                            <input class="form-control" type="text" name="name" required="" placeholder="Nom du produit">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input class="form-control" type="text" name="description" required="" placeholder="Description">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Image</label>
                        <input type="file" class="dropify" data-max-file-size="1M" />
                    </div>
                    
                        <div class="form-group d-flex flex-column align-items-center">
                            <label>Disponibilité à la vente</label>
                            <input type="checkbox" data-toggle="switchery" name="dispnobilitySale" data-color="#df3554" />
                            <label>Prix de la vente</label>
                            <input type="text" data-toggle="touchspin" name="price_purchase" data-step="1" value="0" data-bts-postfix="€" class="form-control"data-color="#df3554" />
                        </div>
                        <div class="form-group d-flex flex-column align-items-center">
                            <label>Disponibilité à la location</label>
                            <input type="checkbox" data-toggle="switchery" name="dispnobilityRental" data-color="#df3554" />
                            <label>Prix de la location</label>
                            <input type="text" data-toggle="touchspin" name="price_rental" data-step="1" value="0" data-bts-postfix="€" class="form-control"data-color="#df3554" />
                        </div>
                    
                    <div class="form-group d-flex flex-column align-items-center">
                        <label>Disponibilité à l'evenementiel</label>
                        <input type="checkbox" data-toggle="switchery" name="dispnobilityEvent" data-color="#df3554" />
                    </div>
                    <div class="form-group">
                        <label>Nombre de stockage disponible</label>
                        <input type="number" name="dispnobilityStock" min="0" class="form-control">
                    </div>
            </div>
            <div class="mb-3 text-center">
                <button class="btn btn-primary btn-block" type="submit">Ajouter le produit</button>
            </div>
            </form>
        </div>
    </div>


    <div class="row col-8">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Listes de tout les produits</h4>

                    <table id="datatables" class="table dt-responsive">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Date de création</th>
                                <th>Desription</th>
                                <th>Prix location</th>
                                <th>Prix à l'achat</th>
                                <th>Stock</th>
                                <th>Disponibilité:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($allProduct as $allProduct) {
                                    echo "<tr>
                                            <td>" . $allProduct['name'] . "</td>
                                            <td>" . $allProduct['creation_date'] . "</td>
                                            <td><button type='button' class='btn btn-lg btn-danger' data-bs-toggle='popover' data-bs-title='azertyui' data-bs-content='zdzdzd'>Description</button></td>
                                            " ;
                                            
                                            if ($allProduct['price_rental'] == 0){
                                                echo "<td> Non dispnobile à la location</td>";
                                            }else{
                                                echo "<td>" . $allProduct['price_rental'] . "€</td>";
                                            }
                                            if ($allProduct['price_purchase'] == 0){
                                                echo "<td> Non dispnobile à la vente</td>";
                                            }else{
                                                echo "<td>" . $allProduct['price_purchase'] . "€</td>";
                                            }
                                            echo "
                                            <td>" . $allProduct['stock'] . "</td>

                                            
                                            <td>";
                                        if ($allProduct['allow_rental'] == 0) {
                                            echo '<span class="mx-5">Location : <i class="text-success fas fa-check" id="subscriptionOption_pricing2"></i></span>';
                                            
                                        } else {
                                            echo '<span class="mx-5">Location : <i class="text-danger fas fa-times" id="subscriptionOption_pricing4"></i></span>';
                                        }
                                        if ($allProduct['allow_purchase'] == 0) {
                                            echo '<span class="mx-5">Vente : <i class="text-success fas fa-check" id="subscriptionOption_pricing2"></i></span>';
                                        } else {
                                            echo '<span class="mx-5">Vente : <i class="text-danger fas fa-times" id="subscriptionOption_pricing4"></i></span>';
                                        }
                                        if ($allProduct['allow_event'] == 0) {
                                            echo '<span class="mx-5">Éveneme:<i class="text-success fas fa-check" id="subscriptionOption_pricing2"></i></span>';
                                        } else {
                                            echo '<span class="mx-5">Éveneme:<i class="text-danger fas fa-times" id="subscriptionOption_pricing4"></i></span>';
                                        }
                                    echo "
                                    </td>
                                    </tr>";

                                }

                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

