        <?php
        $actualDay = date('l');

        foreach ($days as $day) {
            $isToDay = $day == $actualDay ? "font-weight-bold" : "text-muted";

            echo "<div class=\"row\">";
            echo "<div class=\"col-3\">";
            echo "<p class=\"card-text p-0 m-0 " . $isToDay . "\">" . $day . "</p>";
            echo "</div>";

            echo "<div class=\"col-9\">";


            $temp = array_filter($cookLocations['opening_hours'], function ($opening_hour) use ($day) {
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