<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h5>Informations de la location</h5>
                        <p><b>Numéro de la location :</b> <?= $rentCart['id_rent_cart'] ?></p>
                        <p><b>Nom du client :</b> <?= ucfirst($rentCart['name']) . " " . ucfirst($rentCart['surname']) ?></p>
                        <p><b>Date de début :</b> <?= $rentCart['start_date'] ?></p>
                        <p><b>Date de fin :</b> <?= $rentCart['end_date'] ?></p>
                        <p><b>Statut :</b> <?= fancyStatutRent($rentCart['status']) ?></p>
                    </div>
                    <div class="col-6">
                        <h5>Adresse de facturation</h5>
                        <p><b>Adresse :</b> <?= $rentCart['address'] ?></p>
                        <p><b>Code postal :</b> <?= $rentCart['zip_code'] ?></p>
                        <p><b>Ville :</b> <?= $rentCart['city'] ?></p>
                        <p><b>Numéro de téléphone :</b> <?= $rentCart['phone'] ?></p>
                        <p><b>Adresse email :</b> <?= $rentCart['email'] ?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Action sur la commande -->
    <div class="col-6">
        <div class="card card-animate">
            <div class="card-body">
                <h5>Actions sur la commande</h5>
                <p class="text-muted">Appuyez sur le bouton ci-dessous pour modifier le statut de la commande lorsque les produits ont été récupérés par le client</p>

                <div class="row">
                    <div class="col-6">
                        <?php 
                        if($rentCart['status'] === TO_COLLECT) : ?>
                            <a href="<?= $path_prefix ?>rentService/clientUpdate/<?= $rentCart['id_rent_cart'] ?>" class="btn btn-success">Commande récupéré par le client</a>
                        <?php elseif($rentCart['status'] === COLLECTED) : ?>
                            <a href="<?= $path_prefix ?>rentService/clientUpdate/<?= $rentCart['id_rent_cart'] ?>" class="btn btn-info">Commande rendu par le client</a>
                        <?php else: ?>
                            <p class="text-muted">Aucune action disponible</p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card-animate">
            <div class="card-body">
                <h3 class="card-title d-inline-block mb-3">Produits de la location</h3>

                <table id="datatable" class="table nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">En Stock</th>
                            <th scope="col">Statut Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($equipment as $product) : ?>
                            <tr>
                                <td><?= $product['id_equipment'] ?></td>
                                <td><?= $product['name'] ?></td>
                                <td><?= $product['price_rental'] ?> €</td>
                                <td><?= $product['quantity'] ?></td>
                                <td><?= $product['stock'] ?></td>
                                <td><?= $product['stock'] > $product['quantity'] ? "<span class='text-success'>Disponible</span>" : "<span class='text-danger'>Rupture de stock</span>" ?></td>
                            </tr>
                        <?php endforeach; ?>

                </table>
            </div>
        </div>
    </div>
</div>