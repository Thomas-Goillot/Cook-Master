<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-lg-8">
        <div class="card card-animate">
            <div class="card-body">
                <form action="<?= $path_prefix ?>subscription/store" method="POST">

                    <h4 class="card-title d-inline-block mb-3"><i class="fas fa-list-ul"></i> Création d'un abonnement</h4>

                    <div class="row">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" maxlength="40" name="SubscriptionName" id="SubscriptionName" class="form-control" id="thresholdconfig" placeholder="" />
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="SubscriptionIcon">Icon</label>
                                <select class="form-control fas" id="SubscriptionIcon" name="SubscriptionIcon">
                                    <option value="fas fa-glass-cheers">fas fa-glass-cheers</option>
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <label>Options</label>

                        <select class="form-control select2-multiple" name="SubscriptionOptions[]" id="SubscriptionOptions" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                            <optgroup label="Subscriptions options">
                                <?php
                                foreach ($allSubscriptionOption as $feature) {
                                    echo '<option value="' . $feature['id_subscription_option'] . '">' . $feature['name'] . '</option>';
                                }
                                ?>
                            </optgroup>
                        </select>

                    </div>

                    <div class="form-group">
                        <label>Type de livraison</label>

                        <select class="form-control select2-multiple" name="SubscriptionShippingType[]" id="SubscriptionShippingType" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                            <optgroup label="Shipping Type">
                                <?php
                                foreach ($allSubscriptionShippingType as $shippingType) {
                                    echo '<option value="' . $shippingType['id_shipping_type'] . '">' . $shippingType['name'] . '</option>';
                                }
                                ?>
                            </optgroup>
                        </select>

                    </div>

                    <div class="form-group">
                        <label>Type de récompense</label>

                        <select class="form-control select2-multiple" name="SubscriptionRewards[]" id="SubscriptionRewards" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                            <optgroup label="Rewards">
                                <?php
                                foreach ($allSubscriptionRewards as $rewards) {
                                    echo '<option value="' . $rewards['id_rewards'] . '">' . $rewards['name'] . '</option>';
                                }
                                ?>
                            </optgroup>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Type de livraison</label>

                        <select class="form-control" name="SubscriptionRenewalBonus" id="SubscriptionRenewalBonus" data-placeholder="Choose ...">
                            <optgroup label="Renewal Bonus">
                                <?php
                                foreach ($allSubscriptionRenewalBonus as $renewalBonus) {
                                    echo '<option value="' . $renewalBonus['id_renewal_bonus'] . '">' . $renewalBonus['amount'] . ' ' . $renewalBonus['currency'] . ' ' . $renewalBonus['payment_periodicity'] . '</option>';
                                }
                                ?>
                            </optgroup>
                        </select>

                    </div>

                    <div class="form-group">
                        <label>Nombre d'access au leçon par mois <span class="text-muted">(-1 = illimité)</span></label>
                        <input data-toggle="touchspin" name="SubscriptionAccessToLessons" id="SubscriptionAccessToLessons" data-step="1" data-decimals="0" data-min="-1" type="text">
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12 form-group">
                            <label>Prix / mois</label>
                            <input data-toggle="touchspin" name="SubscriptionPriceMonthly" id="SubscriptionPriceMonthly" value="0" type="text" data-step="0.5" data-bts-postfix="/ mois">
                        </div>

                        <div class=" col-lg-6 col-sm-12 form-group">
                            <label>Prix / an</label>
                            <input data-toggle="touchspin" name="SubscriptionPriceYearly" id="SubscriptionPriceYearly" value="0" type="text" data-step="0.5" data-decimals="2" data-bts-postfix="/ an">
                        </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-primary btn-block w-25">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>