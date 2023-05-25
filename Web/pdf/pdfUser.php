<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <link href="../assets/css/pdf/userInformations.css" rel="stylesheet">
    <title>User informations</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: white;">
    <header style ="background-color:#9E1B21; padding:8px; color:white;">
        <div style="display: flex; flex-direction: column; align-items: center;">
            <h3>Cookmaster 2023</h3>
            <p>Tous droits réservés.</p>
        </div>
</header>
    <h1 class="centre1" style="display: flex; justify-content: center; margin-bottom: 4rem; color: black;">Vos informations utilisateurs</h1>
    <div style="display : flex; flex-direction : column; justify-content : space-between;">
    <table classe="border: solid white 2px; width: 100%;">
        <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
            <th style = "padding: 4px;">Nom</th>
        </thead style = "padding: 4px;">
        <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
            <th style = "padding: 4px;"><?= ucfirst($data['name']) ?></th>
        </tbody>

        <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
            <th style = "padding: 4px;">Prénom</th>
        </thead style = "padding: 4px;">
        <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
            <th style = "padding: 4px;"><?= ucfirst($data['surname']) ?></th>
        </tbody>

        <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
            <th style = "padding: 4px;">Email</th>
        </thead style = "padding: 4px;">
        <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
            <th style = "padding: 4px;"><?= $data['email'] ?></th>
        </tbody>

        <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
            <th style = "padding: 4px;">Validée</th>
        </thead style = "padding: 4px;">
        <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
            <th style = "padding: 4px;"><?= $this->isVerified($data['mail_verified']) ?></th>
        </tbody>

        <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
            <th style = "padding: 4px;">Téléphone</th>
        </thead style = "padding: 4px;">
        <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
            <th style = "padding: 4px;"><?= $data['phone'] ?></th>
        </tbody>

        <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
            <th style = "padding: 4px;">Adresse</th>
        </thead style = "padding: 4px;">
        <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
            <th style = "padding: 4px;"><?= $data['address'] ?></th>
        </tbody>

        <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
            <th style = "padding: 4px;">Ville</th>
        </thead style = "padding: 4px;">
        <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
            <th style = "padding: 4px;"><?= ucfirst($data['city']) ?></th>
        </tbody>

        <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
            <th style = "padding: 4px;">Code Postal</th>
        </thead style = "padding: 4px;">
        <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
            <th style = "padding: 4px;"><?= $data['zip_code'] ?></th>
        </tbody>

        <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
            <th style = "padding: 4px;">Pays</th>
        </thead style = "padding: 4px;">
        <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
            <th style = "padding: 4px;"><?= $data['country'] ?></th>
        </tbody>

        <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
            <th style = "padding: 4px;">Abonnement</th>
        </thead style = "padding: 4px;">
        <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
            <th style = "padding: 4px;"><?= $data['subscription'] ?></th>
        </tbody>

        <thead style="background-color: #9E1B21; color: #fff; text-align: left;">
            <th style = "padding: 4px;">Date de création</th>
        </thead style = "padding: 4px;">
        <tbody style="padding: 4px; border-bottom: 1px solid #ddd;">
            <th style = "padding: 4px;"><?= $this->convertDateFrench($data['creation_date']) ?></th>
        </tbody>
    </table>
    </div>
</body>
</html>