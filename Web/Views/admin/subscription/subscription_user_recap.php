<?php 
foreach($subscriptionsNumber as $subscription){
    echo "
    <div class=\"col-xl-4 col-md-6\">
        <div class=\"card card-animate\">
            <div class=\"card-body\">
                <div class=\"avatar-sm float-right\">
                    <span class=\"avatar-title bg-soft-primary rounded-circle\">
                        <i class=\"". $subscription['icon'] ." m-0 h3 text-primary\"></i>
                    </span>
                </div>
                <h6 class=\"text-muted text-uppercase mt-0\">". $subscription['name']."</h6>
                <h3 class=\"my-3\">". $subscription['subscription_total']. " utilisateurs</h3>
                <span class=\"badge badge-soft-primary mr-1\"> + " . $subscription['subscription_this_month'] . "</span> <span class=\"text-muted\">utilisateurs ce mois ci</span>
            </div>
        </div>
    </div>
    ";
}
?>