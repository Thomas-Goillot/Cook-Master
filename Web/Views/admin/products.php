<?php
include_once('Views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-lg-4">
        <div class="card card-animate">
            <div class="card-body">
                <form action="<?= $path_prefix ?>admin/addProduct" method="POST">
                    <div class="form-group">
                        <label">Nom</label>
                        <input class="form-control" type="text" name="name" required="" placeholder="Nom du produit">
                    </div>


                    <div class="form-group">
                        <label>Description</label>
                        <input class="form-control" type="text" name="description" required="" placeholder="Description">
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="dropify" data-height="100" accept="image/png, image/jpeg" required="">
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="form-group d-flex flex-column align-items-center">
                            <label>Disponibilité à la vente</label>
                            <input type="checkbox" data-toggle="switchery" name="dispnobilitySale" data-color="#df3554"/>
                        </div>

                        <div class="form-group d-flex flex-column align-items-center">
                            <label>Disponibilité à la location</label>
                            <input type="checkbox" data-toggle="switchery" name="dispnobilityRental" data-color="#df3554"/>
                        </div>
                    </div>
                    <div class="form-group d-flex flex-column align-items-center">
                        <label>Disponibilité à l'evenementiel</label>
                        <input type="checkbox" data-toggle="switchery" name="dispnobilityEvent" data-color="#df3554"/>
                    </div>

                    <div class="form-group">
                        <label>Nombre de stockage disponible</label>
                        <input type="number" name="dispnobilityStock" min="0" class="form-control">
                    </div>
            </div>

            <div class="mb-3 text-center">
                <button class="btn btn-primary btn-block" type="submit">Ajouter le produit</button>
            </div>
            </form>



        </div>
    </div>
</div>
</div>


