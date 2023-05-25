<div class="card">
    <div class="card-body">
        <h4 class="card-title">Table des mots</h4>

        <table id="datatable" class="table nowrap">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($swearWords as $word) {
                    echo '<tr>';
                    echo '<td>' . ucfirst($word['word']) . '</td>';
                    echo "<td> 
                        <form action=\"".$path_prefix."moderation/deleteWord\" method=\"POST\">
                            <input type=\"hidden\" name=\"WordId\" value=\"". $word['id_words']. "\" />
                            <button type=\"submit\" class=\"btn btn-link text-danger\"><i class=\"bx bx-trash\"></i></button>
                        </form>
                    </td>";
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        
    </div>
</div>