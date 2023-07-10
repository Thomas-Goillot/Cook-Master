<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Création d'une formation </h4>

                <form class="needs-validation" action="<?= $path_prefix ?>training/save" method="post" novalidate>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Titre</label>
                            <input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Titre" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Prix</label>
                            <input type="text" class="form-control" id="validationCustom01" name="price" placeholder="Prix" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Atelier</label>
                        <select class="form-control select2-multiple" name="workshop[]" id="workshop" data-toggle="select2" multiple="multiple" data-placeholder="Choose workshop...">
                            <?php
                            foreach ($workshops as $workshop) {
                                echo '<option value="' . $workshop['id_workshop'] . '">' . $workshop['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Prestataires</label>
                        <select class="form-control select2-multiple" name="providers[]" id="providers" data-toggle="select2" multiple="multiple" data-placeholder="Choose workshop...">
                            <?php
                            foreach ($providers as $provider) {
                                echo '<option value="' . $provider['id_providers'] . '">' . ucfirst($provider['name']) . ' ' . ucfirst($provider['surname']) . ' </option>';
                            }
                            ?>
                        </select>
                    </div>

                    <button class="btn btn-primary" type="submit">Créer</button>
                </form>


            </div>
        </div>
    </div>
</div>