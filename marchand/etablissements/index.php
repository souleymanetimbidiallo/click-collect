<?php
require('../../config.php');
session_start();

if(isset($_SESSION['id'])){
    $conn = connexion();
    $id_user = $_SESSION['id'];
    $sql = "SELECT * 
            FROM etablissement
            WHERE id_user = :id_user";

    $select = $conn->prepare($sql);
    $select->bindParam(':id_user', $id_user);


    $select->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Etablissements</title>
    <link rel="stylesheet" href="../../style.css">
    <style>
        table th{
            background-color: lime;
        }
    </style>
</head>

<body>
    <h1>Gestion des établissements</h1>
    <p><a href="add.php">Ajouter</a></p>
    <table border=1>
        <tr>
            <th>Nom</th>
            <th>Adresse</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th colspan=3>Actions</th>
        </tr>
        <?php while ($etab = $select->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?= $etab['nom'] ?></td>
                <td><?= $etab['adresse'] ?></td>
                <td><?= $etab['telephone'] ?></td>
                <td><?= $etab['email'] ?></td>
                <td><a href="show.php?id=<?= $etab['id_eta'] ?>">Voir</a></td>
                <td><a href="edit.php?id=<?= $etab['id_eta'] ?>">Editer</a></td>
                <td><a href="delete.php?id=<?= $etab['id_eta'] ?>">Supprimer</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <p><a href="../index.php">Retour à l'accueil</a></p>
</body>

</html>
<?php
}
?>