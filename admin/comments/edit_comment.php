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
    
    $sql = "SELECT * FROM commentaire WHERE id_com = :id";
    
    $select = $connexion->prepare($sql);
    $select->bindParam(':id', $id);
    
    $select->execute();
    $comment = $select->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['submit'])) {
        $sql = "UPDATE commentaire
                SET contenu = :contenu
                WHERE id_com = :id";
    
        $edit = $connexion->prepare($sql);
    
        $edit->bindParam(":contenu", $contenu);
        $edit->bindParam(":id", $id);
    
        
        
        // récupérer le login 
        $contenu = secure($_POST['contenu']);
    
        $edit->execute();

        if($edit->rowCount() != 0){
            header("Location: index.php");
        }


    }
  ?>
    <form class="box" action="" method="post" align="center">
      <h1 class="box-logo box-title"></h1>
      <h1 class="box-title">Edit Comment N°<?=$id?></h1>
      
      <div>
      <textarea class="box-input" name="contenu" rows="5" cols="25"/><?=$comment["contenu"]?></textarea>
      </div>

      <div><input type="password" readonly class="box-input" name="id_user" placeholder="<?=$comment["id_user"]?>" required /></div>
      
      <div> <input type="submit" name="submit" value="Modifier" class="box-button" /></div>
    </form>
  <?php 
  }

  ?>
</body>

</html>