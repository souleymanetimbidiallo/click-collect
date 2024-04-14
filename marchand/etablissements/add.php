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
  
  if (isset($_SESSION['id'])) {
    $conn = connexion();

    $sql1  = "SELECT * FROM type_categorie";
    $select1 = $conn->query($sql1);

    $sql2  = "SELECT * FROM type_produit";
    $select2 = $conn->query($sql2);
    
    if(isset($_POST['submit'])){
      $sql = "INSERT into etablissement (nom, adresse, telephone, email, presentation, id_user, id_cat, id_pro, coordonnees)
            VALUES (:nom, :adresse, :telephone, :email, :presentation, :id_user, :id_cat, :id_pro, :coordonnees)";

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
      <div><input type="text" class="box-input" name="nom" placeholder="Nom" required /></div>
      <div><textarea class="box-input" name="adresse" placeholder="Adresse" required /></textarea></div>
      <div><input type="tel" class="box-input" name="telephone" placeholder="Téléphone" required /></div>
      <div><input type="email" class="box-input" name="email" placeholder="Email" required /></div>
      <div><textarea class="box-input" name="presentation" placeholder="Présentation" /></textarea></div>
      <div><textarea class="box-input" name="coordonnees" placeholder="Coordonnées GPS" /></textarea></div>
      
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
      
      <div> <input type="submit" name="submit" value="Ajouter" class="box-button" /></div>
    </form>
  <?php }


  ?>
</body>

</html>