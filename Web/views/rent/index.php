<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-12">
        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title">Historique de mes locations</h4>
                <table id="datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom Prénom </th>
                            <th>Etat</th>
                            <th>Statut</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allRent as $rent) : ?>
                            <tr>
                                <td><?= $rent['id_rent_cart'] ?></td>
                                <td><?= $rent['name'] . " " . $rent['surname'] ?></td>
                                <td><?= $rent['state'] ?></td>
                                <td><?= fancyStatutRent($rent['status']) ?></td>
                                <td><?= $rent['date'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>