<div class="card card-animate">
    <div class="card-body">
        <h4 class="card-title">Modèles d'évènements</h4>

        <div id="accordion" class="custom-accordion mb-4">

            <?php
            foreach ($eventsTemplate as $eventTemplate) {
                echo "
                <div class=\"card mb-0\">
                <div class=\"card-header\" id=\"heading" . $eventTemplate['id_event_template'] . "\">
                    <h5 class=\"m-0 font-size-15\">
                        <a class=\"d-block pt-2 pb-2 text-dark\" data-toggle=\"collapse\" href=\"#eventTemplate" . $eventTemplate['id_event_template'] . "\" aria-expanded=\"true\" aria-controls=\"collapseOne\">
                            " . $eventTemplate['name'] . " <span class=\"float-right\"><i class=\"mdi mdi-chevron-down accordion-arrow\"></i></span>
                        </a>
                    </h5>
                </div>
                <div id=\"eventTemplate" . $eventTemplate['id_event_template'] . "\" class=\"collapse\" aria-labelledby=\"heading" . $eventTemplate['id_event_template'] . "\" data-parent=\"#accordion\">
                    <div class=\"card-body\">
                        <p>" . $eventTemplate['description'] . "</p>
                        <small class=\"text-muted\">Prix d'entré: " . $eventTemplate['price'] . " €</small>
                    </div>
                </div>
            </div>
            ";
            }
            ?>
        </div>
    </div>
</div>