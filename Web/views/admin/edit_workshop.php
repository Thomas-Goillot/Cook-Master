<?php
include_once('views/layout/dashboard/path.php');
?>

<head>
    <link href="<?= $path_prefix ?>assets/css/products/products.css" rel="stylesheet" />
</head>

<div class="d-flex justify-content-center">
    <div class="card card-animate">
        <div class="card-body">
            <form action="<?= $path_prefix ?>WorkshopAdmin/editWorkshop/<?= $id_workshop ?>" method="POST" enctype="multipart/form-data">
                <h1 data-translation-key="Modification du produit"></h1>
                <?php include_once('views/admin/workshop/form.php'); ?>
            </form>

            <div class="d-flex flex-column justify-content-center align-items-center">


                <a href="<?= $path_prefix ?>WorkshopAdmin/listWorkshop"><button type='button' class='btn b btn-secondary mt-4 mb-2 btn-rounded' data-dismiss='modal' data-translation-key="Annuler"></button></a>
                <button type='button' class='btn b btn-primary btn-rounded' data-toggle='modal' data-target='#workshop' data-translation-key="Suprimmer"></button>
            </div>
        </div>
    </div>






    <div class='modal' id='workshop' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>


                <div class='modal-header d-flex flex-column align-items-center text-center'>

                    <h1 class='delete' data-translation-key="Attention, toute supression est définitive."></h1>
                    <h4 data-translation-key="Voulez vous vraiment supprimer cet atelier ?"></h4>
                </div>

                <div class='modal-footer d-flex flex-column'>
                    <form action='<?= $path_prefix ?>WorkshopAdmin/deleteWorkshop/<?= $id_workshop ?>' command method='POST' enctype='multipart/form-data' class='d-flex flex-column align-items-center'>
                        <button type='submit' class='btn btn-primary mt-4 mb-2 btn-rounded small' data-translation-key="Confirmer"></button>
                        <button type='button' class='btn btn-secondary mt-4 mb-2 btn-rounded small' data-dismiss='modal' data-translation-key="Annuler"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>