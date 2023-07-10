<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <?php foreach ($trainings as $training) : ?>
        <div class="col-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?= $training['name'] ?></h4>
                    <p class="card-text text-muted"><?= $training['price'] ?> €</p>
                    <a href="<?=$path_prefix?>jobTraining/show/<?= $training['id_job_training'] ?>" class="btn btn-primary">Voir</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>