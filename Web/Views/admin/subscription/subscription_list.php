<?php
include_once('Views/layout/dashboard/path.php');
?>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Table des Abonnements</h4>

                <table id="datatable-subscription" class="table dt-responsive nowrap">
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
                        foreach($subscriptionAllInfo as $subscription){
                            echo "<tr>
                            <td>" . $subscription['name'] . "</td>
                            <td>" . $subscription['price_monthly'] . "</td>
                            <td>" . $subscription['price_yearly'] . "</td>
                            <td>" . $this->isActive($subscription['is_active']) . "</td>
                            <td>
                                <a href=\"../subscription/edit/" . $subscription['id_subscription'] . "\" class=\"btn btn-primary btn-sm\">Modifier</a>

                                <a href=\"../subscription/delete/" . $subscription['id_subscription'] . "\" class=\"btn btn-danger btn-sm\">Supprimer</a>
                            </td>";
                        }
                        ?>
            

                    </tbody>
                </table>

            </div>
        </div>
    </div>