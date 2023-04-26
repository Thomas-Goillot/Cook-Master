<?php
include_once('Views/layout/dashboard/path.php');
?>



<div class="d-flex justify-content-center">
    <div class="card card-animate">
        <div class="card-body">


            <form action="<?= $path_prefix?>admin/editProduct/<?= $id_equipment?>" method="POST" enctype="multipart/form-data">
                <h1>Modifiction du produit</h1>
                <?php include_once('Views/shop/form.php'); ?>
            </form>
        </div>
    </div>