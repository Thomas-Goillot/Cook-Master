<?php
    include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-12">
         <div class="card">
            <div class="card-body">
                <h4 class="card-title">Prestations</h4>
                <p class="card-subtitle mb-4">
                    Voici les différentes prestations disponibles pour l'inscription.
                </p>
                <table id="datatable" class="table dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Mail</th>
                            <th>Date</th>
                            <th>Equipement</th>
                            <th>Nourriture</th>
                            <th>Menu</th>
                            <th>Couverts</th>
                            <th>Actions</th>
                            <th>Lieu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($getAllHomeServiceRequest as $info){

                                $addresse = $info["address"] .= ", ";

                                $addresse .= $info["city"];
                        
                                $addresse  .= " ";
                        
                                $addresse .= $info["zip_code"];

                                echo    '<tr>
                                            <td>' . $info['name'] . '</td>
                                            <td><a href="mailto:' . $info["email"] . '">' . $info["email"] . '</a></td>
                                            <td>' . $info["date"] . '</td>';
                                            if($info["type_equipment"] == 1){
                                                echo '<td>Equipement client</td>';
                                            }else{
                                                echo '<td>Kit de cuisine</td>';
                                            }

                                            if($info["type_equipment"] == 1){
                                                echo '<td>Produits du clients</td>';
                                            }else{
                                                echo '<td>Produits du chef</td>';
                                            }
                                            echo'<td><a href="'. $path_prefix.'Recipes/RecipeDisplay/'.$info['id_recipes'].'" >Entrée</a>';
                                            echo '<br>';
                                            echo'<a href="'. $path_prefix.'Recipes/RecipeDisplay/'.$info['id_recipes_1'].'" >Plat</a>';
                                            echo '<br>';
                                            echo'<a href="'. $path_prefix.'Recipes/RecipeDisplay/'.$info['id_recipes_2'].'" >Dessert</a></td>';
                                            echo '<td>' . $info["nb_places"] . ' personnes</td>
                                                <td>
                                                    <form action="'. $path_prefix .'RegistrationService/registration/'.$info['id_providers'].'/'.$info['id_home_service'].'" method="POST">
                                                        <input type="hidden" name="id_providers" value="'.$info['id_providers'].'" />
                                                        <input type="hidden" name="id_home_service" value="'.$info['id_home_service']. '" />
                                                        <button type="submit" class="btn btn-primary"><i class="mdi mdi-progress-check"></i> Accepter</button>
                                                    </form> 
                                                </td>
                                                <td><a href="https://www.google.com/maps/search/?api=1&query=' . $addresse . '" target="_blank">' . $addresse . '</a></td>
                                                
                                        </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->