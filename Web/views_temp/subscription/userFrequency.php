<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                Abonnement mensuel
            </div>
            <div class="card-body">
                <h4 class="card-title"><?= $subscriptionInfo['price_monthly'] ?>€/mois</h4>
                <p class="card-text">Payer chaque mois pour accéder à tous nos contenus premium</p>
                <form method="POST" action="../UserSubscription/recap">
                    <input type="hidden" name="idSubscription" value="<?= $subscriptionInfo['id_subscription'] ?>">
                    <input type="hidden" name="typeSubscription" value="monthly">
                    <button type="submit" class="btn btn-primary">S'abonner</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                Abonnement annuel
            </div>
            <div class="card-body">
                <h4 class="card-title"><?= $subscriptionInfo['price_yearly'] ?>€/an</h4>
                <p class="card-text">Payer chaque année pour accéder à tous nos contenus premium</p>
                <form method="POST" action="../UserSubscription/recap">
                    <input type="hidden" name="idSubscription" value="<?= $subscriptionInfo['id_subscription'] ?>">
                    <input type="hidden" name="typeSubscription" value="yearly">
                    <button type="submit" class="btn btn-primary">S'abonner</button>
                </form>
            </div>
        </div>
    </div>
</div>