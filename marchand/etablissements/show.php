<?php 
require("../../config.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn = connexion();

    $select2 = $conn->prepare("SELECT p.login as login, c.contenu as contenu,
                            c.date_com as date, p.type as type
                            FROM commentaire c
                            JOIN personne p
                            ON c.id_user = p.id
                            WHERE c.id_eta = :id_eta");
    $select2->bindParam(':id_eta', $id_eta);
    $id_eta = $_GET['id'];
    $select2->execute();

    $sql = "SELECT et.id_eta as id_eta, et.nom as nom, et.adresse as adresse, 
            et.telephone as tel, et.email as email, p.login as login, 
            cat.titre as categorie, pro.titre as produit
            FROM etablissement as et
            JOIN personne as p
            ON et.id_user = p.id 
            JOIN type_categorie as cat
            ON et.id_cat = cat.id_cat
            JOIN type_produit as pro
            ON et.id_pro = pro.id_pro
            WHERE id_eta = :id";

    $select = $conn->prepare($sql);
    $select->bindParam(':id', $id);

    $select->execute();
    $etab = $select->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etablissement N° <?=$etab['id_eta'] ?></title>
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <table>
        <tr>
            <th>Nom</th>
            <td><?= $etab['nom'] ?></td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td><?= $etab['adresse'] ?></td>
        </tr>
        <tr>
            <th>Téléphone</th>
            <td><?= $etab['tel'] ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= $etab['email'] ?></td>
        </tr>
        <tr>
            <th>Marchand</th>
            <td><?= $etab['login'] ?></td>
        </tr>
        <tr>
            <th>Catégorie</th>
            <td><?= $etab['categorie'] ?></td>
        </tr>
        <tr>
            <th>Produit</th>
            <td><?= $etab['produit'] ?></td>
        </tr>
    </table>
    <form action="comment.php?id=<?=$_GET['id']?>" method="POST">
        <div>
            <textarea name="contenu" id="" cols="50" rows="5" placeholder="Mettez un commentaire"></textarea>
        </div>
        <div>
            <input type="submit" name="comment" value="Commenter">
        </div>
    </form>
        <?php while($comment = $select2->fetch(PDO::FETCH_ASSOC)): ?>
            <p><strong>
                <?php if($comment['type']==="marchand") : ?>
                    
                    <?=$comment['login'];?>(marchand)
                <?php else: ?>
                    <?=$comment['login'];?>
                <?php endif; ?></strong> 
                :
                <?=$comment['contenu'];?> à
                <?=$comment['date'];?>
            </p>
        <?php endwhile; ?>
    <p><a href="index.php">Retour</a></p>
</body>

</html>
<?php
}
?>