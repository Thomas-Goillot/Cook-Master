<head>
    <link href="<?= $path_prefix ?>assets/css/products/products.css" rel="stylesheet" />
</head>
<?php
include_once('views/layout/dashboard/path.php');
?>
<div class="row">
    <div class="col-lg-4">
        <div class="card card-animate">
            <div class="card-body">
                <form action="<?= $path_prefix ?>admin/addProduct" method="POST" enctype="multipart/form-data">
                    <?php include_once('views/shop/form.php'); ?>
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
                                    <th data-translation-key="Nom"></th>
                                    <th data-translation-key="Date de création"></th>
                                    <th data-translation-key="Prix location"></th>
                                    <th data-translation-key="Prix l'achat"></th>
                                    <th data-translation-key="Stock"></th>
                                    <th data-translation-key="Disponibilité">:</th>
                                    <th data-translation-key="Modifier / supprimer"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($allProduct as $allProduct) {
                                    echo "<tr>
                                            <td>" . $allProduct['name'] . "</td>
                                            <td>" . $allProduct['creation_date'] . "</td>";

                                    if ($allProduct['price_rental'] == 0) {
                                        echo "<td data-translation-key=\"Non disponible à la location\"></td>";
                                    } else {
                                        echo "<td>" . $allProduct['price_rental'] . "€</td>";
                                    }
                                    if ($allProduct['price_purchase'] == 0) {
                                        echo "<td data-translation-key=\"Non disponible à la vente\"></td>";
                                    } else {
                                        echo "<td>" . $allProduct['price_purchase'] . "€</td>";
                                    }
                                    echo "
                                            <td>" . $allProduct['stock'] . "</td>

                                            
                                            <td>";
                                    if ($allProduct['allow_rental'] == 0) {
                                        echo '<div class="stretch"><span class="mx" data-translation-key="Location">: <i class="text-success fas fa-check" id="subscriptionOption_pricing2"></i></span>';
                                    } else {
                                        echo '<div class="stretch"><span class="mx" data-translation-key="Location">: <i class="text-danger fas fa-times" id="subscriptionOption_pricing4"></i></span>';
                                    }
                                    if ($allProduct['allow_purchase'] == 0) {
                                        echo '<span class="mx" data-translation-key="Ventes">: <i class="text-success fas fa-check" id="subscriptionOption_pricing2"></i></span>';
                                    } else {
                                        echo '<span class="mx" data-translation-key="Ventes"><i class="text-danger fas fa-times" id="subscriptionOption_pricing4"></i></span>';
                                    }
                                    if ($allProduct['allow_event'] == 0) {
                                        echo '<span class="mx" data-translation-key="Évenement">: <i class="text-success fas fa-check" id="subscriptionOption_pricing2"></i></span></div>';
                                    } else {
                                        echo '<span class="mx" data-translation-key="Évenement">: <i class="text-danger fas fa-times" id="subscriptionOption_pricing4"></i></span>';
                                    }
                                    echo "
                                    </td>

                                    <td>                  
                                    <a href='" . $path_prefix . "admin/editProductDisplay/" . $allProduct['id_equipment'] . "'><button type='submit' class='btn btn-primary mt-4 mb-2 btn-rounded small' data-translation-key=\"Modifier\"></button></a>
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