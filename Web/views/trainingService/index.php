<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste de vos formations</h4>

                <div class="table-responsive">
                    <table id="datatable" class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($trainings as $training) : ?>
                                <tr>
                                    <td><?= $training['name'] ?></td>
                                    <td><?= $training['price'] ?> €</td>
                                    <td>
                                        <a href="<?= $path_prefix ?>trainingService/show/<?= $training['id_job_training'] ?>" class="btn btn-primary">Voir</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>