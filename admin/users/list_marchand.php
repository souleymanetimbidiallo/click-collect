<?php
require('../../config.php');

$conn = connexion();
$sql = "SELECT * FROM personne WHERE type = 'marchand' ";

$select = $conn->query($sql);

//$select->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des marchands</title>
</head>

<body>
    <h1>Liste des marchands</h1>
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
    <p><a href="index.php">Voir la liste principale</a></p>
</body>

</html>