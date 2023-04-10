<?php
include_once('Views/layout/dashboard/path.php');
?>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="dropdown float-right position-relative">
                <a href="#" class="dropdown-toggle h4 text-muted" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="../subscription/create" class="dropdown-item">Créer un nouvel abonnement</a></li>
                </ul>
            </div>
            <h4 class="card-title">Table des Abonnements</h4>

            <table id="datatable" class="table dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>€/Mois</th>
                        <th>€/an</th>
                        <th>Disponible</th>
                        <th>
                            Action :
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($subscriptionAllInfo as $subscription) {
                        echo "<tr>
                            <td>" . $subscription['name'] . "</td>
                            <td>" . $subscription['price_monthly'] . "</td>
                            <td>" . $subscription['price_yearly'] . "</td>
                            <td>" . $this->isActive($subscription['is_active']) . "</td>
                            <td>
                                <a href=\"../subscription/edit/" . $subscription['id_subscription'] . "\" class=\"btn btn-primary btn-sm\">Modifier</a>
                            </td>";
                    }
                    ?>

                </tbody>
            </table>

        </div>
    </div>
</div>