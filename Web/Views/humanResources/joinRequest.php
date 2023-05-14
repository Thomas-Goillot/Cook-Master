<?php
    include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-12">
         <div class="card">
            <div class="card-body">
                <h4 class="card-title">Candidatures postées par les utilisateurs</h4>
                <table id="basic-datatable" class="table dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Identité</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Numéro de siret</th>
                            <th>CV</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($getAllRequest as $request){
                                echo '<td><img src="' . $path_prefix  . 'assets/images/request/pictures/' . $request['image'] . '" class="img-thumbnail"></td>';
                                echo '<td>' . $request['name'] . ' ' . $request['surname'] . '</td>';
                                echo '<td>' . $request['phone'] . '</td>';
                                echo '<td>' . $request['email'] . '</td>';
                                echo '<td>' . $request['siret'] . '</td>';
                                echo '<td><embed src="' . $path_prefix  . 'assets/images/request/cv/' . $request['file'] . '" class="img-thumbnail" type="application/pdf"></td>';
                            };
                        ?>
                    </tbody>
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->