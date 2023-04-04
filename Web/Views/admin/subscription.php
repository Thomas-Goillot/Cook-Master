<?php
include_once('Views/layout/dashboard/path.php');
?>

<div class="row">
    <?php include_once('Views/admin/subscription/subscription_user_recap.php'); ?>
</div>

<div class="row">

    <?php include_once('Views/admin/subscription/subscription_list.php'); ?>

</div>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Récapitulatif</h4>
        </div>
    </div>
</div>


<div class="row">

    <?php include_once('Views/admin/subscription/subscription_option.php'); ?>

    <?php include_once('Views/admin/subscription/subscription_rewards.php'); ?>

    <?php include_once('Views/admin/subscription/subscription_shipping_type.php'); ?>

</div>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Prévisualisation</h4>
        </div>
    </div>
</div>

<?php
include_once('Views/subscription/pricing.php');

?>