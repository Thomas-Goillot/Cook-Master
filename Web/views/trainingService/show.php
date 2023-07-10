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
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des participants</h4>

                <ul>
                    <?php foreach ($listeUsers as $user) : ?>
                        <li><?= ucfirst($user['name']) ?> <?= ucfirst($user['surname']) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-8">

        <?php foreach($training['workshop'] as $workshop) : ?>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Atelier <?= $workshop['name'] ?></h4>
                <p class="card-text text-muted">Description : <?= $workshop['description'] ?></p>
                <a href="<?= $path_prefix ?>trainingService/workshop/<?= $workshop['id_workshop'] ?>/<?= $training['id_job_training'] ?>" class="btn btn-primary">Voir</a>
            </div>
        </div>
        <?php
        endforeach;
        ?>
    </div>
</div>