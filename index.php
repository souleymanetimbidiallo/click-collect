<?php
require('config.php');

$conn = connexion();

$sql = "SELECT * FROM type_categorie";

$select = $conn->query($sql);

$sql2 = "SELECT * FROM type_produit";

$select2 = $conn->query($sql2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <title>E-Shopping</title>
</head>
<body>
    <header>
        <a href="#" class="logo"><span>E-</span>Shopping</a>
        <ul class="navbar">
            <li><a href="index.php">accueil</a></li>
            <li><a href="">a propos</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="login.php">connexion</a></li>
            <li><a href="register.php" class="btn-reserve">inscription</a></li>
        </ul>
    </header>
    <section>
        <p>
        Type de catégorie: 
        <?php while ($cat = $select->fetch(PDO::FETCH_ASSOC)) : ?>
          <a href="#"><?=$cat['titre'];?></a>
        <?php endwhile; ?>

        </p>
        <p>Type de produit:
        
        <?php while ($pro = $select2->fetch(PDO::FETCH_ASSOC)) : ?>
          <a href="#"><?=$pro['titre'];?></a>
        <?php endwhile; ?>
    </p>
    </section>
    <section class="banniere" id="banniere">
        <div class="contenu">
            <h2>Le plaisir de Shopper le Shopping</h2>
            <p> <span>S'S </span>vous propose 1000 nouveautés par jour pendant toutes les saisons. Faites vos courses en ligne, economisez plus et rendez--vous la vie plus simple</p>
            <a href="#" class="btn1">Visiter</a>
            <a href="#" class="btn2">Connexion</a>
        </div>
    </section>

    <section class="apropos" id="apropos">
        <div class="row">
            <div class="col50">
                <h2 class="titre-texte"><span>A </span>Propos De Nous</h2>
                <p>
                    je sais pas encore ce que je dois mettre le site propose de vetements de marques fairtes cos achats en ligne te au aurez des coupons de reductions et les frais de livraison sont gratiots . alors faites vous plaisir les reines du shopping
                </p>
            </div>
            <div class="col50">
                <div class="img ">
                    <img src="shopping.png" alt="notre logo">
                </div>
            </div>
        </div>
    </section>
    <section class="menu" id="menu">
        <div class="titre">
            <div class="col50">
                <h2 class="titre-texte"><span>S</span>hopping</h2>
                <p>
                    Seectionner vos articles et ajouter dans le panier
                </p>
            </div>
    </section>
</body>
</html>