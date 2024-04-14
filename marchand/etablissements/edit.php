<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../../style.css" />
  <meta charset='utf-8'>
</head>

<body>
  <?php
  //creation d'un admin ou utilisateur par l'admin
  require('../../config.php');
  session_start();
  
  if (isset($_SESSION['id']) && isset($_GET['id'])) {
    $conn = connexion();

    $select1 = $conn->query("SELECT * FROM type_categorie");

    $select2 = $conn->query("SELECT * FROM type_produit");
    
    $select3 = $conn->prepare("SELECT * FROM etablissement WHERE id_eta = :id");
    $select3->bindParam(':id', $_GET['id']);
    
    $select3->execute();
    $eta = $select3->fetch(PDO::FETCH_ASSOC);
    
    if(isset($_POST['submit'])){
      $sql = "UPDATE etablissement
              SET nom =:nom, adresse = :adresse, telephone = :telephone, email = :email, 
              presentation = :presentation, id_user = :id_user, id_cat = :id_cat, 
              id_pro = :id_pro, coordonnees = :coordonnees
              WHERE id_eta = :id";

      $insert = $conn->prepare($sql);

      $insert->bindParam(":nom", $nom);
      $insert->bindParam(":adresse", $adresse);
      $insert->bindParam(":telephone", $telephone);
      $insert->bindParam(":email", $email);
      $insert->bindParam(":presentation", $presentation);
      $insert->bindParam(":coordonnees", $coordonnees);
      $insert->bindParam(":id_user", $id_user);
      $insert->bindParam(":id_cat", $id_cat);
      $insert->bindParam(":id_pro", $id_pro);
      $insert->bindParam(":id", $_GET['id']);

      
      $nom = secure($_POST['nom']);
      
      $adresse = secure($_POST['adresse']);
      
      $telephone = secure($_POST['telephone']);
      
      $email = secure($_POST['email']);

      $presentation = secure($_POST['presentation']);

      $id_user = $_SESSION['id'];
      
      $id_cat = secure($_POST['id_cat']);

      $id_pro = secure($_POST['id_pro']);
      
      

      $coordonnees= secure($_POST['coordonnees']);

      $insert->execute();

      if ($insert->rowCount() != 0) {
        header("Location: index.php");
      }else{
        die("Erreur");
      }
    }
  ?>
    <form class="box" action="" method="post" align="center">
      <h1 class="box-logo box-title"></h1>
      <h1 class="box-title">Ajouter un établissement</h1>
      <div><input type="text" class="box-input" name="nom" placeholder="Nom" required value="<?=$eta['nom']?>" /></div>
      <div><textarea class="box-input" name="adresse" placeholder="Adresse" required /><?=$eta['adresse']?></textarea></div>
      <div><input type="tel" class="box-input" name="telephone" placeholder="Téléphone" value="<?=$eta['telephone']?>" /></div>
      <div><input type="email" class="box-input" name="email" placeholder="Email"  value="<?=$eta['email']?>" /></div>
      <div><textarea class="box-input" name="presentation" placeholder="Présentation" /><?=$eta['presentation']?></textarea></div>
      <div><textarea class="box-input" name="coordonnees" placeholder="Coordonnées GPS" /><?=$eta['coordonnees']?></textarea></div>
      
      <div>
        <select name="id_cat">
          <?php while($cat = $select1->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?=$cat['id_cat']?>"><?=$cat['titre']?></option>
          <?php endwhile; ?>
        </select>
      </div>
      
      <div>
        <select name="id_pro">
          <?php while($pro = $select2->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?=$pro['id_pro']?>"><?=$pro['titre']?></option>
          <?php endwhile; ?>
        </select>
      </div>
      
      <div> <input type="submit" name="submit" value="Modifier" class="box-button" /></div>
    </form>
    <p><a href="add_photo.php?id=<?=$_GET['id']?>">Ajouter des photos</a></p>
  <?php }


  ?>
</body>

</html>

</html>