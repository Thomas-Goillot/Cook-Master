<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <title>Certificat "<?= $data['certificate']['name'] ?>"</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: white;">
    <header style="background-color:#9E1B21; padding:8px; color:white;">
        <div style="display: flex; flex-direction: column; align-items: center;">
            <h3>Cookmaster 2023</h3>
            <p>Tous droits réservés.</p>
        </div>
    </header>
    <h1 class="centre1" style="display: flex; justify-content: center; margin-bottom: 2rem; color: black;">Certificat de validation de compétences</h1>
    <p>Je soussigné, CookMaster 2023, certifie que <?= ucfirst($data['name']) ?> <?= ucfirst($data['surname']) ?> est en possession des compétences suivantes :</p>
    <div style="display : flex; flex-direction : column; justify-content : space-between;">
        <table classe="border: solid white 2px; width: 100%;">

            <?php foreach ($data['certificate']['skills'] as $skill) : ?>

                <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
                    <th style="padding: 4px;"><?= ucfirst($skill['name']) ?></th>
                </thead style="padding: 4px;">
                <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
                    <th style="padding: 4px;"><?= ucfirst($skill['description']) ?></th>
                </tbody>

            <?php endforeach; ?>



        </table>
    </div>
</body>

</html>