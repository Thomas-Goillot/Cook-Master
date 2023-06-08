<div class="card">
    <div class="card-body">
        <h4 class="card-title">Liste des compétences</h4>

        <table id="datatable" class="table dt-responsive nowrap">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($skills as $skill) {
                    echo '<tr>';
                    echo '<td>' . $skill['name'] . '</td>';
                    echo '<td>' . $skill['description'] . '</td>';
                    echo '</tr>';
                }
                ?>

            </tbody>
        </table>

    </div>
</div>