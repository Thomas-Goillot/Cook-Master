<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" data-translation-key="TableUtilisateurs"></h4>

                <table id="datatable" class="table dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th data-translation-key="Nom"></th>
                            <th data-translation-key="Mail"></th>
                            <th data-translation-key="Phone"></th>
                            <th data-translation-key="Etat"></th>
                            <th data-translation-key="Action"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($users as $user) {
                            echo '<tr>';
                            echo '<td>' . ucfirst($user['name']) . ' ' . ucfirst($user['surname']) . '</td>';
                            echo '<td>' . $user['email'] . '</td>';
                            echo '<td>' . $user['phone'] . '</td>';
                            echo '<td>' . isBan($user['is_banned']) . '</td>';
                            echo '<td>
                            <div class="d-flex justify-content-between">
                                <form action="' . $path_prefix . 'admin/updateIsBanUser/' . $user['id_users'] . '" method="POST" class="px-4">
                                ';
                            if ($user['is_banned'] == 1) {
                                echo '<button type="submit" class="btn btn-success btn-sm" data-translation-key="Debannir"></button>';
                            } else {
                                echo '<button type="submit" class="btn btn-danger btn-sm" data-translation-key="Bannir"></button>';
                            }
                            echo '
                                </form>
                            </div>
                                </td>';
                            echo '</tr>';
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" data-translation-key="TableUtilisateurs"></h4>

                <table id="datatable" class="table dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th data-translation-key="Nom"></th>
                            <th data-translation-key="Mail"></th>
                            <th data-translation-key="Phone"></th>
                            <th data-translation-key="Etat"></th>
                            <th data-translation-key="Action"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($users as $user) {
                            echo '<tr>';
                            echo '<td>' . ucfirst($user['name']) . ' ' . ucfirst($user['surname']) . '</td>';
                            echo '<td>' . $user['email'] . '</td>';
                            echo '<td>' . $user['phone'] . '</td>';
                            echo '<td>' . isBan($user['is_banned']) . '</td>';
                            echo '<td>
                            <div class="d-flex justify-content-between">
                                <form action="' . $path_prefix . 'admin/updateIsBanUser/' . $user['id_users'] . '" method="POST" class="px-4">
                                ';
                            if ($user['is_banned'] == 1) {
                                echo '<button type="submit" class="btn btn-success btn-sm" data-translation-key="Debannir"></button>';
                            } else {
                                echo '<button type="submit" class="btn btn-danger btn-sm" data-translation-key="Bannir"></button>';
                            }
                            echo '
                                </form>
                            </div>
                                </td>';
                            echo '</tr>';
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>