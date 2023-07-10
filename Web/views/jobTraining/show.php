<?php
include_once('views/layout/dashboard/path.php');
?>


<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Information sur <?= $training['name'] ?></h4>

                <p class="card-text text-muted">Organisé par :</p>
                <ul>
                    <?php foreach ($training['providers'] as $provider) : ?>
                        <li><?= ucfirst($provider['name']) ?> <?= ucfirst($provider['surname']) ?></li>
                    <?php endforeach; ?>
                </ul>

                <p class="card-text text-muted">Prix : <?= $training['price'] ?> €</p>

                <?php if ($userIsInTraining === true) : ?>
                    <p class="card-text text-success">Vous êtes déjâ inscrit à cette formation</p>
                <?php else : ?>
                    <a href="<?= $path_prefix ?>jobTraining/join/<?= $training['id_job_training'] ?>" class="btn btn-primary">S'inscrire</a>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <div class="col-8">

        <?php foreach($training['workshop'] as $workshop) : ?>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Atelier <?= $workshop['name'] ?></h4>
                <p class="card-text text-muted">Description : <?= $workshop['description'] ?></p>
            </div>
        </div>
        <?php
        endforeach;
        ?>
    </div>
</div>