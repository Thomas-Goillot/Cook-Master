<div class="row justify-content-center">
    <div class="col-xl-10">
        <div class="row mt-sm-5 mt-3 mb-3">

            <?php
            foreach ($subscriptionAllInfo as $subscription) {
                echo "
            <div class=\"col-md-4\">
                <div class=\"card card-pricing\">
                    <div class=\"card-body text-center\">
                        <i class=\"card-pricing-icon " . $subscription['icon'] . " text-white bg-primary\"></i>
                        <h5 class=\"font-weight-bold mt-4 text-uppercase\">".$subscription['name']. "</h5>

                        <ul class=\"card-pricing-features\">
                            ";

                        foreach ($subscription['subscription_option'] as $feature) {
                            $feature['name'] = str_replace('_', ' ', $feature['name']);
                            echo "<li>
                                <i class=\"text-success fas fa-check\"></i> " . ucfirst(strtolower($feature['name'])) . "
                                </li>";
                        }

                        echo "
                        </ul>

                        <div class=\"d-flex justify-content-around align-items-center\">
                                <h4 class=\"mt-4\">" . $subscription['price_monthly'] . "€ <span class=\"text-muted\">/mois</span></h4>
                                <h4 class=\"mt-4 text-muted\">ou</h4>
                                <h4 class=\"mt-4\">" . $subscription['price_yearly'] . "€ <span class=\"text-muted\">/an</span></h4>
                        </div>
                        <button class=\"btn btn-primary mt-4 mb-2 btn-rounded\">Get Started <i class=\"mdi mdi-arrow-right ml-1\"></i></button>
                    </div>
                </div>
            </div>";
            }
            ?>

        </div>
    </div>
</div>