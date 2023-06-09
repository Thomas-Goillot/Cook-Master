<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="avatar-sm float-right">
                    <span class="avatar-title bg-soft-primary rounded-circle">
                        <i class="bx bx-pie-chart-alt-2 font-size-24 m-0 h3 text-primary"></i>
                    </span>
                </div>
                <h6 class="text-muted text-uppercase mt-0">Nombre de Total</h6>
                <h3 class="my-3"><?= count($allSales) ?></h3>
                <span class="badge badge-soft-primary mr-1"><?= count($allSales) ?></span> <span class="text-muted">ventes au total</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="avatar-sm float-right">
                    <span class="avatar-title bg-soft-primary rounded-circle">
                        <i class="bx bx-line-chart font-size-24 m-0 h3 text-primary"></i>
                    </span>
                </div>
                <h6 class="text-muted text-uppercase mt-0">Nombre de ventes</h6>
                <h3 class="my-3"><?= count($allSalesThisMonth) ?></h3>
                <span class="badge badge-soft-primary mr-1"><?= count($allSalesThisMonth) ?></span> <span class="text-muted">ventes ce mois-ci</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="avatar-sm float-right">
                    <span class="avatar-title bg-soft-primary rounded-circle">
                        <i class="bx bxs-ship font-size-24 m-0 h3 text-primary"></i>
                    </span>
                </div>
                <h6 class="text-muted text-uppercase mt-0">Nombre de commandes livrées</h6>
                <h3 class="my-3"><?= count($allDelivered) ?></h3>
                <span class="badge badge-soft-primary mr-1"><?= count($allDelivered) ?></span> <span class="text-muted">commandes livrées ce mois-ci</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="avatar-sm float-right">
                    <span class="avatar-title bg-soft-primary rounded-circle">
                        <i class="bx bx-archive-in font-size-24 m-0 h3 text-primary"></i>
                    </span>
                </div>
                <h6 class="text-muted text-uppercase mt-0">Nombre de commandes archivées</h6>
                <h3 class="my-3"><?= count($allArchived) ?></h3>
                <span class="badge badge-soft-primary mr-1"><?= count($allArchived) ?></span> <span class="text-muted">commandes archivées ce mois-ci</span>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-12">
        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title">Listes des ventes</h4>
                <table id="datatable" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom Prénom Client</th>
                            <th>Date</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allSalesOverAll as $sale) : ?>
                            <tr>
                                <td><?= $sale['id_shopping_cart'] ?></td>
                                <td><?= ucfirst($sale['name']) . ' ' . ucfirst($sale['surname']) ?></td>
                                <td><?= $sale['date_purchase'] ? date('d/m/Y', strtotime($sale['date_purchase'])) : '' ?></td>
                                <td><?= fancyCommandStatut($sale['id_command_status']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>