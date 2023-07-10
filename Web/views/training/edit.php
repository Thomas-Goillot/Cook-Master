<?php
include_once('views/layout/dashboard/path.php');
?>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Création d'une formation </h4>

                <form class="needs-validation" action="<?= $path_prefix ?>training/editSave" method="post" novalidate>
                    <input type="hidden" name="id_training" value="<?= $training['id_job_training'] ?>">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Titre</label>
                            <input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Titre" required value="<?= $training['name'] ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Prix</label>
                            <input type="text" class="form-control" id="validationCustom01" name="price" placeholder="Prix" required value="<?= $training['price'] ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Atelier</label>
                        <select class="form-control select2-multiple" name="workshop[]" id="workshop" data-toggle="select2" multiple="multiple" data-placeholder="Choose workshop...">
                            <?php
                            foreach ($workshops as $workshop) {
                                foreach ($training['workshop'] as $workshop_id) {
                                    echo $workshop_id['id_workshop'];
                                    if ($workshop_id['id_workshop'] === $workshop['id_workshop']) {
                                        $selected = 'selected';
                                        break;
                                    } else {
                                        $selected = '';
                                    }
                                }

                                echo '<option value="' . $workshop['id_workshop'] . '" ' . $selected . '>' . $workshop['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Prestataires</label>
                        <select class="form-control select2-multiple" name="providers[]" id="providers" data-toggle="select2" multiple="multiple" data-placeholder="Choose workshop...">
                            <?php
                            foreach ($providers as $provider) {
                                foreach ($training['providers'] as $provider_id) {
                                    if ($provider_id['id_providers'] === $provider['id_providers']) {
                                        $selected = 'selected';
                                        break;
                                    } else {
                                        $selected = '';
                                    }
                                }



                                echo '<option value="' . $provider['id_providers'] . '" ' . $selected . '>' . ucfirst($provider['name']) . ' ' . ucfirst($provider['surname']) . ' </option>';
                            }
                            ?>
                        </select>
                    </div>

                    <button class="btn btn-primary" type="submit">Modifier</button>
                </form>


            </div>
        </div>
    </div>
</div>