<?php
    include_once('views/layout/dashboard/path.php');
?>

<div class="row">

    <div class="col-xl-6">
         <div class="card">
            <div class="card-body">
                <h4 class="card-title">Utilisateurs</h4>
                <p class="card-subtitle mb-4">Nombre de nouveaux utilisateurs par mois.</p>
                <canvas id="barChart"></canvas>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->

    <div class="col-xl-6">
         <div class="card">
            <div class="card-body">
                <h4 class="card-title">Abonnements</h4>
                <p class="card-subtitle mb-4">Type d'abonnement par utilisateur.</p>
                <canvas id="pieChart"></canvas>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->

</div>
<!-- end row-->

<div class="row">

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nombres de recettes</h4>
                <p class="card-subtitle mb-4">Nombres de recettes par type.</p>
                <div id="morris-donut-example" class="morris-chart"></div>
                </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->

</div>
<!-- end row-->

<script>

    var dataOfUsers = [
        <?php
            echo "{";
            echo "label: \"Nouveaux utilisateurs\",";
            echo "data : [";
            echo $getNumberOfSubscriptionsByDate['janvier'] . "," . $getNumberOfSubscriptionsByDate['fevrier'] . "," . $getNumberOfSubscriptionsByDate['mars'] . "," . $getNumberOfSubscriptionsByDate['avril'] . "," . $getNumberOfSubscriptionsByDate['mai'] . "," . $getNumberOfSubscriptionsByDate['juin'] . "," . $getNumberOfSubscriptionsByDate['juillet'] . "," . $getNumberOfSubscriptionsByDate['aout'] . "," . $getNumberOfSubscriptionsByDate['septembre'] . "," . $getNumberOfSubscriptionsByDate['octobre'] . "," . $getNumberOfSubscriptionsByDate['novembre'] . "," . $getNumberOfSubscriptionsByDate['decembre'];
            echo "],";
            echo "backgroundColor: \"#9e1b21\",";
            echo "},";
        ?>
    ];

    var dataOfSubscriptions = [
        <?php
        
            echo "{";
            echo "data : [";  
            foreach($getCountSubscriptions as $data){
                echo $data['count'] . ",";
            };
            echo "],"; 
            
            echo "backgroundColor: [";
            echo " \"#9e1b21\", ";
            echo " \"#FF957E\", "; 
            echo " \"#FFD0C6\", ";
            echo "],";

            echo "borderColor: [";
            echo " \"#9e1b21\", ";
            echo " \"#FF957E\", ";
            echo " \"#FFD0C6\", ";
            echo "],";
            echo "},";
        ?>
    ];

    var dataOfStarters = [
        <?php
            echo $dataOfStarters_1["COUNT(*)"];
        ?>
    ];

    var dataOfDishes = [
        <?php
            echo $dataOfDishes_1["COUNT(*)"];
        ?>
    ];
    
    var dataOfDesserts = [
        <?php
            echo $dataOfDesserts_1["COUNT(*)"];
        ?>
    ];

</script>