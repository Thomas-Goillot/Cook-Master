<?php
    include_once('Views/layout/dashboard/path.php');
?>
<div class="row col-8">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Listes de tout les ateliers</h4>

                        <table id="datatables" class="table dt-responsive ici2">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Date de création</th>
                                    <th>Place restante :</th>
                                    <th>Prix</th>
                                    <th>Modifier / supprimer</th>
                                </tr>
                            </thead>
                                    <?php 
                                    foreach($allWorkshop as $allWorkshop){

                                        echo "<td>" . $allWorkshop['name'] . "</td>";
                                        echo "<td>" . $allWorkshop['date'] . "</td>";
                                        echo "<td>" . $allWorkshop['available'] . "</td>";
                                        echo "<td>" . $allWorkshop['price'] . "</td>";
                                        echo "<td>" . $allWorkshop['price'] . "</td>";


                                        echo" <td>                  
                                              <a href='" . $path_prefix . "WorkshopAdmin/editWorkshopDisplay/" . $allWorkshop['id_workshop'] . "'><button type='submit' class='btn btn-primary mt-4 mb-2 btn-rounded small'>Modifier</button></a>
                                            </td>";
                                    }
                                    ?>                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>