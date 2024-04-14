<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../style.css" />
  <meta charset='utf-8'>
</head>

<body>
  <?php
  //creation d'un admin ou utilisateur par l'admin
  require('../../config.php');
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $connexion = connexion();
    
    $sql = "SELECT * FROM type_categorie WHERE id_cat = :id";
    
    $select = $connexion->prepare($sql);
    $select->bindParam(':id', $id);
    
    $select->execute();
    $cat = $select->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['submit'])) {
        $sql = "UPDATE type_categorie
                SET titre = :titre
                WHERE id_cat = :id";
    
        $edit = $connexion->prepare($sql);
    
        $edit->bindParam(":titre", $titre);
        $edit->bindParam(":id", $id);
    
        
        
        // récupérer le login 
        $titre = secure($_POST['titre']);
    
        $edit->execute();

        if($edit->rowCount() != 0){
            header("Location: index.php");
        }


    }
  ?>
    <form class="box" action="" method="post" align="center">
      <h1 class="box-title">Edition | Type catégorie N°<?=$id?></h1>


      <div><input type="text" class="box-input" name="titre" placeholder="<?=$cat["titre"]?>" required /></div>
      
      <div> <input type="submit" name="submit" value="Modifier" class="box-button" /></div>
    </form>
  <?php 
  }

  ?>
</body>

</html>