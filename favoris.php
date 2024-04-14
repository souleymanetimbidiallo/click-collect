<?php 
require("config.php");
session_start();
if(isset($_SESSION['id'])){
    $conn = connexion();

    $sql = "SELECT et.id_eta as id_eta, et.nom as nom, et.adresse as adresse, 
            et.telephone as tel, et.email as email, et.presentation as presentation,
            et.coordonnees as coord, p.login as login
            FROM favori f
            JOIN etablissement as et
            ON f.id_eta = et.id_eta
            JOIN personne as p
            ON f.id_user = p.id
            WHERE p.id = :id";

    $select = $conn->prepare($sql);
    $select->bindParam(':id', $id);
    $id = $_SESSION['id'];

    $select->execute();
    //var_dump($_SESSION['id']);die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etablissement N° <?=$etab['id_eta'] ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <p>Mes établissements favoris</p>
    <table border=1>
        <tr>
            <th>Nom</th>
            <th>Adresse</th>
            <th>Téléphone</th>
            <th>Email</th>
        </tr>
        <?php while ($etab = $select->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?= $etab['nom'] ?></td>
                <td><?= $etab['adresse'] ?></td>
                <td><?= $etab['tel'] ?></td>
                <td><?= $etab['email'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <p><a href="index.php">Retour</a></p>
</body>

</html>
<?php
}
?>