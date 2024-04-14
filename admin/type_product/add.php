<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../style.css" />
  <meta charset='utf-8'>
</head>

<body>
  <?php
  
  require('../../config.php');

  if(isset($_POST['submit'])){
      $conn = connexion();

    $insert = $conn->prepare("INSERT into type_produit(titre) VALUES (:titre)");

    $insert->bindParam(":titre", $titre);
    

    // récupérer le contenu
    $titre = secure($_POST['titre']);


    $insert->execute();

    if ($insert->rowCount() != 0) {
      header("Location: index.php");
    }
  }

    
   
  ?>
    <form class="box" action="" method="post" align="center">
      <h1 class="box-logo box-title"></h1>
      <h1 class="box-title">Ajout | Type produit</h1>
      <div>
          <input type="text" name="titre" id="">
      </div>
      <div><input type="submit" name="submit" value="Envoyer" class="box-button" /></div>
    </form>

</body>

</html>