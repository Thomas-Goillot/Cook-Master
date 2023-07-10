<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row js-masonry" data-masonry='{ "itemSelector": ".col-md-4" }'>
    <?php require('formUserProfil.php') ?>
    <?php require('editUserContactForm.php') ?>
    <?php require('editUserAddressForm.php') ?>
    <?php require('editUserPasswordForm.php') ?>
    <?php require('editUserTchatForm.php') ?>
</div>