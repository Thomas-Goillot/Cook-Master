<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des utilisateurs</h4>

                <!-- checkbox de présence -->
                <ul>
                    <?php foreach ($listeUsers as $user) : ?>
                        <li>
                            <div class="d-flex align-items-center">
                                <input type="checkbox" value="<?= $user['id_users'] ?>" onchange="updatePresence(<?= $user['id_users'] ?>, <?= $id_training ?>)">
                                <p class="m-0 px-2"><?= ucfirst($user['name']) ?> <?= ucfirst($user['surname']) ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des equipements</h4>

                <ul>
                    <?php foreach ($equipments as $equipment) : ?>
                        <li>
                            <div class="d-flex align-items-center">
                                <input type="checkbox" id="equipment<?= $equipment['id_equipment'] ?>" value="<?= $equipment['id_equipment'] ?>">
                                <p class="m-0 px-2"><?= $equipment['name'] ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
    </div>

<!--     <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des recettes</h4>

                <ul>
                    <?php foreach ($recipes as $recipe) : ?>
                        <li>
                            <div class="d-flex align-items-center">
                                <p class="m-0 px-2"><?= $recipe['name'] ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
    </div> -->





</div>