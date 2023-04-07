<?php
include_once('Views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-lg-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="dropdown float-right position-relative align-items-center">
                    Actif <input type="checkbox" name="SubscriptionActive" id="SubscriptionActive" checked data-toggle="switchery" data-color="#2e7ce4" data-size="small" />
                </div>
                <h4 class="card-title d-inline-block mb-3"><i class="fas fa-list-ul"></i> Modifier l'Abonnement <?= $subscription['name'] ?></h4>

                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" maxlength="40" name="SubscriptionName" id="SubscriptionName" class="form-control" id="thresholdconfig" placeholder="<?= $subscription['name'] ?>" />
                </div>

                <div class="form-group">
                    <label>Options</label>

                    <select class="form-control select2-multiple" name="SubscriptionOptions" id="SubscriptionOptions" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                        <optgroup label="Subscriptions options">
                            <?php
                            foreach ($subscription['subscription_option'] as $feature) {

                                if ($feature['selected']) {
                                    echo '<option selected value="' . $feature['id_subscription_optio'] . '">' . $feature['name'] . '</option>';
                                } else {
                                    echo '<option value="' . $feature['id_subscription_optio'] . '">' . $feature['name'] . '</option>';
                                }
                            }
                            ?>
                        </optgroup>
                    </select>

                </div>

                <div class="form-group">
                    <label>Nombre d'access au leçon par mois <span class="text-muted">(-1 = illimité)</span></label>
                    <input data-toggle="touchspin" data-step="1" data-decimals="0" data-min="-1" type="text" value="<?= $subscription['access_to_lessons'] ?>">
                </div>

                <div class="row">
                    <div class="col-lg-6 col-sm-12 form-group">
                        <label>Prix / mois</label>
                        <input data-toggle="touchspin" name="SubscriptionPriceMonthly" id="SubscriptionPriceMonthly" value="<?= $subscription['price_monthly'] ?>" type="text" data-step="0.1" data-bts-postfix="/ mois">
                    </div>

                    <div class="col-lg-6 col-sm-12 form-group">
                        <label>Prix / an</label>
                        <input data-toggle="touchspin" name="SubscriptionPriceYearly" id="SubscriptionPriceYearly" value="<?= $subscription['price_yearly'] ?>" type="text" data-step="0.1" data-decimals="2" data-bts-postfix="/ an">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card card-animate">
            <div class="card-body">
                <h4 class="card-title d-inline-block mb-3"><i class="fas fa-list-ul"></i> Information sur Abonnement</h4>

                <div>


                </div>

            </div>
        </div>
    </div>

</div>