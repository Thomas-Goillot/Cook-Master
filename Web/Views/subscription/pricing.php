
<?php
    foreach ($subscriptionAllInfo as $subscription) {
        echo "
    <div class=\"col-md-4\">
        <div class=\"card card-pricing\">
            <div class=\"card-body text-center\">
                <i class=\"card-pricing-icon " . $subscription['icon'] . " text-white bg-primary\" id=\"subscriptionIcon_pricing\"></i>
                <h5 class=\"font-weight-bold mt-4 text-uppercase\" id=\"subscriptionName_pricing\">".$subscription['name']. "</h5>

                <ul class=\"card-pricing-features\">
                    ";

                foreach ($subscription['subscription_option'] as $feature) {

                    if($feature['selected']){
                        echo "<li>
                        <i class=\"text-success fas fa-check\" id=\"subscriptionOption_pricing".$feature['id_subscription_option']."\"></i> " . ucfirst(strtolower($feature['name'])) . "
                        </li>";
                    }
                    else{
                        echo "<li>
                        <i class=\"text-danger fas fa-times\" id=\"subscriptionOption_pricing" . $feature['id_subscription_option'] . "\"></i> " . ucfirst(strtolower($feature['name'])) . "
                        </li>";
                    }

                }

                if($subscription['rewards_name'] != null){
                    echo "<li>
                    <i class=\"text-success fas fa-check\" id=\"subscriptionRewards_pricing\"></i> " . ucfirst(strtolower($subscription['rewards_name'])) . "
                    </li>";
                }
                else{
                    echo "<li>
                    <i class=\"text-danger fas fa-times\" id=\"subscriptionRewards_pricing\"></i> Aucune récompense
                    </li>";
                }


                echo "<li>";                
                if($subscription['shipping_type'] != null){
                    echo "<i class=\"text-success fas fa-check\" id=\"subscriptionShippingType_pricing\"></i>";
                    foreach($subscription['shipping_type'] as $shippingType){
                        $shippingType['name'] = str_replace("_", " ", $shippingType['name']);
                        echo ucfirst(strtolower($shippingType['name'])) ." ";
                    }
                }
                else{
                    echo "<i class=\"text-danger fas fa-times\" id=\"subscriptionShippingType_pricing\"></i> Livraison non incluse";
                }
                echo "</li>";

                 echo "<li>
                    <i class=\"text-success fas fa-check\" id=\"subscriptionRewards_pricing\"></i> " . ucfirst(strtolower($subscriptionAllInfo[0]['access_to_lessons'])) . " de leçon 
                    </li>";

                echo "

                </ul>

                <div class=\"d-flex justify-content-around align-items-center\">
                        <h4 class=\"mt-4\" id=\"subscriptionPriceMonthly_pricing\">" . $subscription['price_monthly'] . "€ <span class=\"text-muted\">/mois</span></h4>
                        <h4 class=\"mt-4 text-muted\">ou</h4>
                        <h4 class=\"mt-4\" id=\"subscriptionPriceYearly_pricing\">" . $subscription['price_yearly'] . "€ <span class=\"text-muted\">/an</span></h4>
                </div>
                <button class=\"btn btn-primary mt-4 mb-2 btn-rounded\">Get Started <i class=\"mdi mdi-arrow-right ml-1\"></i></button>
            </div>
        </div>
    </div>";
    }
?>