<?php
require('../../config.php');

$conn = connexion();

$sql = "SELECT * FROM type_produit";

$select = $conn->query($sql);

//$select->execute();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Types de produit</title>
</head>

<body>
    <p><a href="add.php">Ajouter un type</a></p>
    <h1>Gestion des types de produit</h1>
    <table border=1>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th colspan=3>Actions</th>
        </tr>
        <?php while ($pro = $select->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?php echo $pro['id_pro'] ?></td>
                <td><?= $pro['titre'] ?></td>
                <td><a href="edit.php?id=<?= $pro['id_pro'] ?>">Editer</a></td>
                <td><a href="delete.php?id=<?= $pro['id_pro'] ?>">Supprimer</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <p> <a href="../home.php">Retour</a></p>
</body>

</html>