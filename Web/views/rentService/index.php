<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-12">
        <div class="card card-animate">
            <div class="card-body">
                <h3 class="card-title d-inline-block mb-3">Location en cours</h3>

                <table id="datatable" class="table nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Date de début</th>
                            <th scope="col">Date de fin</th>
                            <th scope="col">Matériel</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allRent as $rent) : ?>
                            <tr>
                                <td><?= $rent['id_rent_cart'] ?></td>
                                <td><?= $rent['name'] ?></td>
                                <td><?= $rent['surname'] ?></td>
                                <td><?= $rent['start_date'] ?></td>
                                <td><?= $rent['end_date'] ?></td>
                                <td><?= $rent['name'] ?></td>
                                <td><?= fancyStatutRent($rent['status']) ?></td>
                                <td>
                                    <a href="<?= $path_prefix ?>rentService/rentDetail/<?= $rent['id_rent_cart'] ?>" class="btn btn-primary btn-sm">Détail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>