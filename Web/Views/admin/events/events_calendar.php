<div class="card">
    <div class="card-body">

        <div id='calendar' class="mt-3 mt-lg-0"></div>

    </div>
</div>
<script>
    var dateEvents = [
        <?php
        foreach ($events as $event) {
            echo "{\n";
            echo "title: '" . $event['name'] . "',\n";
            echo "start: new Date(" . $event['date_start']['year'] . "," . $event['date_start']['month'] . "," . $event['date_start']['day'] . "),\n";
            echo "end: new Date(" . $event['date_end']['year'] . "," . $event['date_end']['month'] . "," . $event['date_end']['day'] . "),\n";
            //echo "url: '../events/edit/" . $event['id_event'] . "'\n";
            echo "},\n";
        }
        ?>
    ];
</script>