<?php
require('../../config.php');

$conn = connexion();

$sql = "SELECT u.prenom as prenom, u.nom as nom, com.id_com as id_com, 
        com.contenu as contenu, com.id_user as id_user, com.date_com as date
        FROM commentaire as com, personne as u
        WHERE u.id = com.id_user
        ORDER BY date DESC";

$select = $conn->query($sql);

//$select->execute();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des commentaires</title>
</head>

<body>
    <p><a href="add_comment.php">Ajouter un commentaire</a></p>
    <h1>Gestion des commentaires</h1>
    <table border=1>
        <tr>
            <th>Numero</th>
            <th style="width:250px;">Commentaire</th>
            <th>Date</th>
            <th>Auteur</th>
            <th colspan=3>Actions</th>
        </tr>
        <?php while ($comments = $select->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?php echo $comments['id_com'] ?></td>
                <td><?= $comments['contenu'] ?></td>
                <td><?= $comments['date'] ?></td>
                <td><?= $comments['prenom'].' '.$comments['nom']; ?></td>
                <td><a href="show_comment.php?id=<?= $comments['id_com'] ?>">Voir</a></td>
                <td><a href="edit_comment.php?id=<?= $comments['id_com'] ?>">Editer</a></td>
                <td><a href="delete_comment.php?id=<?= $comments['id_com'] ?>">Supprimer</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <p> <a href="../home.php">Retour</a></p>
</body>

</html>