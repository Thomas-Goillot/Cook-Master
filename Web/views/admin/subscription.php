<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <?php include_once('views/admin/subscription/subscription_user_recap.php'); ?>
</div>

<div class="row">

    <?php include_once('views/admin/subscription/subscription_list.php'); ?>

</div>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18" data-translation-key="Recapitulatif"></h4>
        </div>
    </div>
</div>


<div class="row">

    <?php include_once('views/admin/subscription/subscription_option.php'); ?>

    <?php include_once('views/admin/subscription/subscription_rewards.php'); ?>

    <?php include_once('views/admin/subscription/subscription_shipping_type.php'); ?>

</div>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18" data-translation-key="Previsualisation"></h4>
        </div>
    </div>
</div>


<div class="row justify-content-center">
    <div class="col-xl-10">
        <div class="row mt-sm-5 mt-3 mb-3">


            <?php
            include_once('views/subscription/pricing.php');

            ?>

        </div>
    </div>
</div>