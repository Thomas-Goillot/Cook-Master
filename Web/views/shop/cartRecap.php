<?php
include_once('views/layout/dashboard/path.php');

?>
<div class="row">
    <div class="col-12 p-0 m-0">

        <div class="card">
            <div class="row">
                <div class="col-md-9 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col">
                                <h4><b>Votre panier</b></h4>
                            </div>
                            <div class="col align-self-center text-right text-muted"><?= $nbProduct ?> élément<?= plural($nbProduct) ?></div>
                        </div>
                    </div>



                    <div class="row border-top border-bottom">
                        <?php
                        foreach ($allProduct as $allProduct) {
                            if ($allProduct['allow_purchase'] == 0) {

                                echo '<div class="row main align-items-center">';
                                echo ' <div class="col-2"><img class="cart-img img-fluid" src="' . $path_prefix  . 'assets/images/productShop/' . $allProduct['image'] . '"></div>';
                                echo '<div class="col">';
                                echo '<div class="row text-muted">' . $allProduct['name'] . '</div>';
                                echo '</div>';

                                echo '<div class="col">';
                                echo '<a href="#">-</a><a href="#" class="border" data-id="' . $allProduct['id_equipment'] . '">' . $allProduct['quantity'] . '</a><a href="#">+</a>';
                                echo '</div>';
                                echo '<div class="col">&euro; ' . $allProduct['price_purchase'] . ' <span class="close" data-id="' . $allProduct['id_equipment'] . '">&#10005;</span></div>';
                                echo '</div>';
                            }
                        }

                        ?>
                    </div>
                    <div class="back-to-shop"><a href="<?= $path_prefix ?>shop">&leftarrow;</a><span class="text-muted">Retour à la boutique</span></div>
                </div>
                <div class="col-md-3 summary">
                    <div>
                        <h5><b>Récapitulatif</b></h5>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col" style="padding-left:0;"><?= $nbProduct ?> élément<?= plural($nbProduct) ?></div>
                        <div class="col text-right">&euro; <?= $sum ?></div>
                    </div>
                    <form method="POST">
                        <p>VOS RECOMPENSES</p>
                        <?php
                        foreach ($vouchers as $voucher) {
                            echo '<div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">';
                            echo '<div class="col">' . $voucher['name'] . ' ' . $voucher['amount'] . ' ' . $voucher['currency'] . ' </div>';
                            echo '<div class="col text-right"><button type="button" name="voucher" class="btn btn-primary" onclick="addVaucher(' . $voucher['id_voucher'] . ',' . $userCartId . ')" data-translation-key="Ajouter"></button></div>';
                            echo '</div>';
                        }
                        ?>
                    </form>
                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">TOTAL</div>
                        <div class="col text-right">&euro; <?= $sum ?></div>
                    </div>
                    <a href="../shop/addressSelect" class="btn btn-primary w-100">SUIVANT</a>
                </div>
            </div>
        </div>

    </div>
</div>