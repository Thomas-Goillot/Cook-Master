<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <h4><b>Votre Commande</b></h4>
                    </div>
                    <div class="float-right">
                        <h4 class="m-0 d-print-none">Facture provisoire</h4>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-6">
                        <h6 class="font-weight-bold">Address de facturation:</h6>

                        <address class="line-h-24">
                            <b><?= ucfirst($user['name']) . " " . ucfirst($user['surname']) ?></b><br>
                            <?= $user['address'] ?><br>
                            <?= $user['country'] ?>, <?= $user['city'] . " " . $user['zip_code']  ?><br>
                            <abbr title="Phone">P:</abbr> <?= $user['phone'] ?>
                        </address>
                    </div>
                    <div class="col-6">
                        <div class="mt-3 float-right">
                            <p class="mb-2"><strong>Date de la commande </strong><?= date('d/m/Y'); ?></p>
                            <p class="mb-2"><strong>Status de la commande </strong> <span class="badge badge-soft-warning">En cours...</span></p>
                            <p class="m-b-10"><strong>Numéro de commande</strong> #<?= $orderId; ?></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table mt-4">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Produit</th>
                                        <th>Quantité</th>
                                        <th>Prix unitaire</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($allProduct as $product) {
                                        if ($product['allow_purchase'] == 0) {
                                            echo '<tr>';
                                            echo '<td>' . $i . '</td>';
                                            echo '<td>';
                                            echo '<b>' . $product['name'] . '</b>';
                                            echo '<br>';
                                            echo $product['description'];
                                            echo '</td>';
                                            echo '<td>' . $product['quantity'] . '</td>';
                                            echo '<td>' . $product['price_purchase'] . ' €</td>';
                                            echo '<td class="text-right">' . $product['price_purchase'] * $product['quantity'] . ' €</td>';
                                            echo '</tr>';
                                            $i++;
                                        }
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="clearfix pt-5">
                            <h6 class="text-muted">Notes:</h6>

                            <small>
                                L'adresse de facturation est celle présente dans votre profil. Si vous souhaitez la modifier, veuillez vous rendre dans votre profil.
                            </small>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="float-right">
                            <p><b>Sous Total:</b> <?= $priceWithoutTva ?> €</p>
                            <p><b>TVA (<?= TVA * 100 ?>):</b> <?= $tva ?> €</p>
                            <h3><?= $sum ?> €EUR</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="d-print-none my-4">
                    <div class="text-right">
                        <a href="../<?= $pathToPayment?>" class="btn btn-info waves-effect waves-light">Payer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>