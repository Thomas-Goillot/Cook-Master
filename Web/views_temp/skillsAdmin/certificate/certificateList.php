<div class="card">
    <div class="card-body">
        <h4 class="card-title">Liste des certificats</h4>

        <table id="datatable" class="table dt-responsive nowrap">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($certificates as $certificate) {
                    echo '<tr>';
                    echo '<td>' . $certificate['name'] . '</td>';
                    echo '<td>' . $certificate['description'] . '</td>';
                    echo '</tr>';
                }
                ?>

            </tbody>
        </table>

    </div>
</div>