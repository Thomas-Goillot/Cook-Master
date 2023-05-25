<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <title>Facture des évènements passés</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: white;">
    <header style ="background-color:#9E1B21; padding:8px; color:white;">
        <div style="display: flex; flex-direction: column; align-items: center;">
            <h3>Cookmaster 2023</h3>
            <p>Tous droits réservés.</p>
        </div>
</header>
    <h1 class="centre1" style="display: flex; justify-content: center; margin-bottom: 4rem; color: black;">Facture des évènements à venir</h1>
    <div style="display : flex; flex-direction : column; justify-content : space-between;">
    <table classe="border: solid white 2px; width: 100%;">

    <?php
        foreach ($data as $data1){
            echo '
                <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
                    <th style = "padding: 4px;">Nom</th>
                </thead style = "padding: 4px;">
                <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
                    <th style = "padding: 4px;">'.ucfirst($data1['name']).'</th>
                </tbody>

                <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
                    <th style = "padding: 4px;">Date de début</th>
                </thead style = "padding: 4px;">
                <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
                    <th style = "padding: 4px;">'.$data1['date_start'].'</th>
                </tbody>

                <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
                    <th style = "padding: 4px;">Date de fin</th>
                </thead style = "padding: 4px;">
                <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
                    <th style = "padding: 4px;">'.$data1['date_end'].'</th>
                </tbody>

                <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
                    <th style = "padding: 4px;">Description</th>
                </thead style = "padding: 4px;">
                <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
                    <th style = "padding: 4px;">'.$data1['description'].'</th>
                </tbody>

                <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
                    <th style = "padding: 4px;">Prix de la place</th>
                </thead style = "padding: 4px;">
                <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
                    <th style = "padding: 4px;">'.$data1['price'].'€</th>
                </tbody>
                <br>
                <br>';
        }
    ?>

    </table>
    </div>
</body>
</html>