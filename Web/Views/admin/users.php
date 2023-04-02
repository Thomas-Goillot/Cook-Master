<?php
include_once('Views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Table des utilisateurs</h4>

                <table id="datatable-users" class="table dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Mail</th>
                            <th>Phone</th>
                            <th>Bannissement</th>
                            <th>
                                Action :
                            </th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        foreach ($users as $user) {
                            echo '<tr>';
                            echo '<td>' . ucfirst($user['name']) . ' ' . ucfirst($user['surname']) . '</td>';
                            echo '<td>' . $user['email'] . '</td>';
                            echo '<td>' . $user['phone'] . '</td>';
                            echo '<td>' . $user['is_banned'] . '</td>';
                            echo '<td>
                            <a href="">Voir le profil</a>
                            <form class="form-inline">
                            <div class="form-group">
                                    <select class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                    </select>
                                </div>
                            <div class="form-group">

                                    <select class="form-control">
                                        <option>Test 1</option>
                                        <option>Test 2</option>
                                    </select>
                                </div>

                            </form>
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