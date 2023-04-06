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
                <h4 class="card-title d-inline-block mb-3"><i class="fas fa-list-ul"></i> Modifier l'Abonnement</h4>

                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" maxlength="40" name="SubscriptionName" id="SubscriptionName" class="form-control" id="thresholdconfig" />
                </div>

                <div class="form-group">
                    <label>Options</label>

                    <select class="form-control select2-multiple" name="SubscriptionOptions" id="SubscriptionOptions" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                        <optgroup label="Alaskan/Hawaiian Time Zone">
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                        </optgroup>
                    </select>

                </div>

                <div class="form-group">
                    <label>Nombre d'access au leçon par mois</label>
                    <input data-toggle="touchspin" type="text" value="0">
                </div>

                <div class="row">
                    <div class="col-lg-6 col-sm-12 form-group">
                        <label>Prix / mois</label>
                        <input data-toggle="touchspin" name="SubscriptionPriceMonthly" id="SubscriptionPriceMonthly" value="18.20" type="text" data-step="0.1" data-decimals="2" data-bts-postfix="/ mois">
                    </div>

                    <div class="col-lg-6 col-sm-12 form-group">
                        <label>Prix / an</label>
                        <input data-toggle="touchspin" name="SubscriptionPriceYearly" id="SubscriptionPriceYearly" value="18.20" type="text" data-step="0.1" data-decimals="2" data-bts-postfix="/ an">
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