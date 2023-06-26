<div class="card card-animate">
    <div class="card-body">
        <h4 class="card-title" data-translation-key="EventTable"></h4>

        <table id="datatable" class="table nowrap">
            <thead>
                <tr>
                    <th data-translation-key="Nom"></th>
                    <th data-translation-key="Prix"></th>
                    <th data-translation-key="N° Place"></th>
                    <th data-translation-key="Id"></th>
                    <th data-translation-key="Action"></th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($events as $event) {
                    echo "<tr>";
                    echo "<td>" . $event['name'] . "</td>";
                    echo "<td>" . $event['price'] . "</td>";
                    echo "<td>" . $event['place'] . "</td>";
                    echo "<td>" . $event['id_users'] . "</td>";
                    echo "<td class=\"d-flex\">
                        <form action=\"" . $path_prefix . "events/deleteEvent\" method=\"POST\">
                            <input type=\"hidden\" name=\"EventId\" value=\"" . $event['id_event'] . "\" />
                            <button type=\"submit\" class=\"btn btn-link text-danger\"><i class=\"bx bx-trash\"></i></button>
                        </form>
                        <form action=\"" . $path_prefix . "admin/editEvent/" . $event['id_event'] . "\" method=\"POST\">
                            <input type=\"hidden\" name=\"EventId\" value=\"" . $event['id_event'] . "\" />
                            <button type=\"submit\" class=\"btn btn-link text-warning\"><i class=\"bx bx-pencil\"></i></button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>
    </div>
</div>