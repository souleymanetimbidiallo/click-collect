<?php
require('../../config.php');

$conn = connexion();
$sql = "SELECT * FROM personne";

$select = $conn->query($sql);

//$select->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Liste des utilisateurs</title>
</head>

<body>
    <p><a href="add_user.php">Ajouter un utilisateur</a></p>
    <h1>Gestion des utilisateurs</h1>
    <table border=1>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Type</th>
            <th colspan=3>Actions</th>
        </tr>
        <?php while ($users = $select->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?php echo $users['id'] ?></td>
                <td><?= $users['nom'] ?></td>
                <td><?= $users['prenom'] ?></td>
                <td><?= $users['type'] ?></td>
                <td><a href="show_user.php?id=<?= $users['id'] ?>">Voir</a></td>
                <td><a href="edit_user.php?id=<?= $users['id'] ?>">Editer</a></td>
                <td><a href="delete_user.php?id=<?= $users['id'] ?>">Supprimer</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <p><a href="list_marchand.php">Voir tous les marchands</a>&nbsp; <a href="../home.php">Retour</a></p>
</body>

</html>