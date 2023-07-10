<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des formations </h4>

                <table id="datatable" class="table nowrap">
                    <thead>
                        <tr>
                            <th>Titre</th>
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
                                    <a href="<?= $path_prefix ?>training/edit/<?= $training['id_job_training'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                                    <a href="<?= $path_prefix ?>training/delete/<?= $training['id_job_training'] ?>" class="btn btn-primary btn-sm">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>