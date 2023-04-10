<?php
include_once('Views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-lg-8">
        <div class="card card-animate">
            <div class="card-body">
                <form action="<?= $path_prefix ?>subscription/update" method="POST">
                    <input type="hidden" name="SubscriptionId" id="SubscriptionId" value="<?= $subscriptionAllInfo[0]['id_subscription'] ?>" />

                    <div class="dropdown float-right position-relative align-items-center">
                        Actif <input type="checkbox" name="SubscriptionActive" id="SubscriptionActive" <?= $subscriptionAllInfo[0]['is_active_checked'] ?> data-toggle="switchery" data-color="#df3554" data-size="small" />
                    </div>

                    <h4 class="card-title d-inline-block mb-3"><i class="fas fa-list-ul"></i> Modifier l'Abonnement <?= $subscriptionAllInfo[0]['name'] ?></h4>

                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" maxlength="40" name="SubscriptionName" id="SubscriptionName" class="form-control" id="thresholdconfig" placeholder="<?= $subscriptionAllInfo[0]['name'] ?>" value="<?= $subscriptionAllInfo[0]['name'] ?>" />
                    </div>

                    <div class="form-group">
                        <label>Nombre d'access au leçon par mois <span class="text-muted">(-1 = illimité)</span></label>
                        <input data-toggle="touchspin" name="SubscriptionAccessToLessons" id="SubscriptionAccessToLessons" data-step="1" data-decimals="0" data-min="-1" type="text" value="<?= $subscriptionAllInfo[0]['access_to_lessons'] ?>">
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12 form-group">
                            <label>Prix / mois</label>
                            <input data-toggle="touchspin" name="SubscriptionPriceMonthly" id="SubscriptionPriceMonthly" value="<?= $subscriptionAllInfo[0]['price_monthly'] ?>" type="text" data-step="0.5" data-bts-postfix="/ mois" onchange="updatePriceMonthly()">
                        </div>

                        <div class=" col-lg-6 col-sm-12 form-group">
                            <label>Prix / an</label>
                            <input data-toggle="touchspin" name="SubscriptionPriceYearly" id="SubscriptionPriceYearly" value="<?= $subscriptionAllInfo[0]['price_yearly'] ?>" type="text" data-step="0.5" data-decimals="2" data-bts-postfix="/ an" onchange="updatePriceYearly()">
                        </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-primary btn-block w-25">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include_once('Views/subscription/pricing.php');
    ?>

    <script>
        const subscriptionName = document.getElementById('SubscriptionName');
        const subscriptionName_pricing = document.getElementById('subscriptionName_pricing');
        const SubscriptionPriceMonthly = document.getElementById('SubscriptionPriceMonthly');
        const subscriptionPriceMonthly_pricing = document.getElementById('subscriptionPriceMonthly_pricing');
        const SubscriptionPriceYearly = document.getElementById('SubscriptionPriceYearly');
        const subscriptionPriceYearly_pricing = document.getElementById('subscriptionPriceYearly_pricing');


        subscriptionName.addEventListener('input', function() {
            subscriptionName_pricing.innerHTML = subscriptionName.value;
        });

        function updatePriceMonthly() {
            subscriptionPriceMonthly_pricing.innerHTML = SubscriptionPriceMonthly.value + '€ /mois';
        }

        function updatePriceYearly() {
            subscriptionPriceYearly_pricing.innerHTML = SubscriptionPriceYearly.value + '€ /an';
        }
    </script>

</div>