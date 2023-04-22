<div class="card card-animate">
    <img class="card-img-top img-fluid" src="../assets/images/location/<?= $location['images'][0]['image'] ?>" alt=" Card image cap">
    <div class="card-body">
        <h5 class="card-title"><?= $location['name'] ?></h5>
        <p class="card-text"><?= $location['address'] ?></p>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Disponible à la location : <span class="card-text p-0 m-0 font-weight-bold"><?php echo $location['available_to_rental'] == 0 ? "Non" : "Oui" ?></span></li>
        <li class="list-group-item">Prix par jour : <span class="card-text p-0 m-0 font-weight-bold"><?= $location['price_day']?> €</span></li>
        <li class="list-group-item">Prix par demi-journée : <span class="card-text p-0 m-0 font-weight-bold"><?= $location['price_half_day']?> €</span></li>
    </ul>
    <div class="card-body">

        <?php //dump($location); ?>

        <?php
        $actualDay = date('l');

        foreach ($days as $day) {
            $isToDay = $day == $actualDay ? "font-weight-bold" : "text-muted";

            echo "<div class=\"row\">";
            echo "<div class=\"col-3\">";
            echo "<p class=\"card-text p-0 m-0 " . $isToDay . "\">" . $day . "</p>";
            echo "</div>";

            echo "<div class=\"col-9\">";


            $temp = array_filter($location['opening_hours'], function ($opening_hour) use ($day) {
                return $opening_hour['opening_day'] == $day;
            });

            if (count($temp) == 0) {
                echo "<p class=\"card-text p-0 m-0" . $isToDay . " text-danger\">Fermé</p>";
            } else {
                foreach ($temp as $opening_hour) {
                    $opening_hour['opening_hours'] = substr($opening_hour['opening_hours'], 0, -3);
                    $opening_hour['closing_hours'] = substr($opening_hour['closing_hours'], 0, -3);
                    echo "<p class=\"card-text p-0 m-0 " . $isToDay . "\">" . $opening_hour['opening_hours'] . " - " . $opening_hour['closing_hours'] . "</p>";
                }
            }

            echo "</div>";

            echo "</div>";
        }
        ?>

    </div>
</div>