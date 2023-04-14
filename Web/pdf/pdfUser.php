<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <title>User informations</title>
</head>
<body>
    <h1>Vos informations utilisateurs</h1>
    <table>
        <thead>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Validée</th>
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Ville</th>
            <th>Code Postal</th>
            <th>Pays</th>
            <th>Abonnement</th>
            <th>Date de création</th>
        </thead>
        <tbody>
            <th><?= ucfirst($data['name']) ?></th>
            <th><?= ucfirst($data['surname']) ?></th>
            <th><?= $data['email'] ?></th>
            <th><?= $this->isVerified($data['mail_verified']) ?></th>
            <th><?= $data['phone'] ?></th>
            <th><?= $data['address'] ?></th>
            <th><?= $data['city'] ?></th>
            <th><?= $data['zip_code'] ?></th>
            <th><?= $data['country'] ?></th>
            <th><?= $data['subscription'] ?></th>
            <th><?= $this->convertDateFrench($data['creation_date']) ?></th>
        </tbody>
    </table>
</body>
</html>