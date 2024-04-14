<?php
require('../../config.php');

$conn = connexion();

$sql = "SELECT * FROM type_categorie";

$select = $conn->query($sql);

//$select->execute();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Types de catégorie</title>
</head>

<body>
    <p><a href="add.php">Ajouter un type</a></p>
    <h1>Gestion des types de catégorie</h1>
    <table border=1>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th colspan=3>Actions</th>
        </tr>
        <?php while ($cat = $select->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?php echo $cat['id_cat'] ?></td>
                <td><?= $cat['titre'] ?></td>
                <td><a href="edit.php?id=<?= $cat['id_cat'] ?>">Editer</a></td>
                <td><a href="delete.php?id=<?= $cat['id_cat'] ?>">Supprimer</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <p> <a href="../home.php">Retour</a></p>
</body>

</html>