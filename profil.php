<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["login"])){
    header("Location: login.php");
  }
  require('config.php');

  $conn = connexion();

  $select1 = $conn->query("SELECT * FROM type_categorie");

  $select2 = $conn->query("SELECT * FROM type_produit");

  $select = $conn->query("SELECT * FROM etablissement");

  if(isset($_POST['search'])){
    $sql = "SELECT *
            FROM etablissement
            WHERE id_cat = :id_cat AND id_pro = :id_pro AND adresse = :adresse";
    
    $select = $conn->prepare($sql);
    $select->bindParam(':id_cat', $id_cat);
    $select->bindParam(':id_pro', $id_pro);
    $select->bindParam(':adresse', $adresse);

    $id_cat = $_POST['id_cat'];
    $id_pro = $_POST['id_pro'];
    $adresse = $_POST['adresse'];
    $select->execute();
  }
?>
<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="style.css" />
  <meta charset="utf-8"> 
  </head>
  <body>
    <div class="sucess">
    <header>

      <h1>Bienvenue <?php echo $_SESSION['login']; ?>!</h1>
      <img src="images/logo.png" alt="">
    </header>
    <p>Cest votre espace utilisateur. <a href="logout.php">Déconnexion</a></p>
    <p><a href="favoris.php">Voir mes établissements favoris </a></p>

    <div>
      <h1>Recherche multi-critères</h1>
      <form action="" method="POST">
        <div>
          <select name="id_cat">
            <?php while($cat = $select1->fetch(PDO::FETCH_ASSOC)): ?>
              <option value="<?=$cat['id_cat']?>"><?=$cat['titre']?></option>
            <?php endwhile; ?>
          </select>

        <select name="id_pro">
          <?php while($pro = $select2->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?=$pro['id_pro']?>"><?=$pro['titre']?></option>
          <?php endwhile; ?>
        </select>
        
        <input type="text" name="adresse" placeholder="Adresse">

        <input type="submit" name="search" value="Rechercher">
        </div>

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
                <td><a href="etablissement_show.php?id=<?= $etab['id_eta'] ?>">Voir la fiche</a></td>
                <td><a href="save_etab.php?id=<?= $etab['id_eta'] ?>">Sauvegarder</a></td>
                <td><a href="send_etab.php?id=<?= $etab['id_eta'] ?>">Partager</a></td>
            </tr>
        <?php endwhile; ?>
    </table>

      </form>
    </div>
    
    </div>
  </body>
</html>