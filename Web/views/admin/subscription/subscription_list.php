<?php include_once('views/layout/dashboard/path.php'); ?>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="dropdown float-right position-relative">
                <a href="#" class="dropdown-toggle h4 text-muted" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="../subscription/create" class="dropdown-item" data-translation-key="Créer un nouvel abonnement"></a></li>
                </ul>
            </div>
            <h4 class="card-title" data-translation-key="Table des Abonnements"></h4>

            <table id="datatable" class="table dt-responsive nowrap">
                <thead>
                    <tr>
                        <th data-translation-key="Nom"></th>
                        <th data-translation-key="€/Mois"></th>
                        <th data-translation-key="€/an"></th>
                        <th data-translation-key="Disponible"></th>
                        <th>
                            <span data-translation-key="Action :"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subscriptionAllInfo as $subscription) { ?>
                        <tr>
                            <td><?php echo $subscription['name']; ?></td>
                            <td><?php echo $subscription['price_monthly']; ?></td>
                            <td><?php echo $subscription['price_yearly']; ?></td>
                            <td><?php echo $this->isActive($subscription['is_active']); ?></td>
                            <td>
                                <a href="../subscription/edit/<?php echo $subscription['id_subscription']; ?>" class="btn btn-primary btn-sm" data-translation-key="Modifier"></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>