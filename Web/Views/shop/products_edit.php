<?php
include_once('Views/layout/dashboard/path.php');
?>
<head>
    <link href="<?= $path_prefix ?>assets/css/products/products.css" rel="stylesheet" />
</head>

<div class="d-flex justify-content-center">
    <div class="card card-animate">
        <div class="card-body">
        <div class="d-flex justify-content-end align-items-center">
            <button type='button' class='btn btn-outline-danger btn-rounded small w-30' data-toggle='modal' data-target='#equipment'>Suprimmer </button>
            </div>

            <form action="<?= $path_prefix?>admin/editProduct/<?= $id_equipment?>" method="POST" enctype="multipart/form-data">
                <h1>Modifiction du produit</h1>
                <?php include_once('Views/shop/form.php'); ?>
            </form>
            <div class="d-flex justify-content-center align-items-center">
            <a href="<?= $path_prefix?>admin/products"><button type='button'  class='btn btn-secondary mt-4 mb-2 btn-rounded small' data-dismiss='modal'>Annuler</button></a>
            </div>
        </div>
    </div>






                <div class='modal' id='equipment' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>


                        <div class='modal-header d-flex flex-column align-items-center text-center'>
                                
                            <h1 class='delete'>Attention, toute supression est définitive.</h1>
                            <h4>Voulez vous vraiment supprimer ce produit ?</h4>   
                            </div>
                            
                            <div class='modal-footer d-flex flex-column'>
                            <form action='<?= $path_prefix?>admin/deleteProduct/<?= $id_equipment?>' command method='POST' enctype='multipart/form-data' class='d-flex flex-column align-items-center'>
                                <button type='submit' class='btn btn-primary mt-4 mb-2 btn-rounded small'>Confirmer</button>
                                <button type='button'  class='btn btn-secondary mt-4 mb-2 btn-rounded small' data-dismiss='modal'>Annuler</button>
                            </form>
                            </div> 
                        </div>
                    </div>
                </div>