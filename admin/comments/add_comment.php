<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../style.css" />
  <meta charset='utf-8'>
</head>

<body>
  <?php
  
  require('../../config.php');
  $conn = connexion();
  $sql = "SELECT id, login FROM personne";
  $select = $conn->query($sql);


$insert = $conn->prepare($sql);

    if(isset($_POST['submit'])){
      $conn = connexion();
      $sql = "INSERT into `commentaire` (contenu, id_user)
            VALUES (:contenu, :id_user)";

    $insert = $conn->prepare($sql);

    $insert->bindParam(":contenu", $contenu);
    $insert->bindParam(":id_user", $id_user);
    

    // récupérer le contenu
    $contenu = secure($_POST['contenu']);

    $id_user = secure($_POST['id_user']);

    $insert->execute();

    if ($insert->rowCount() != 0) {
      echo "<div class='sucess'>
             <h3>commentaire envoyé avec succès.</h3>
             <p>Cliquez <a href='index.php'>ici</a>Gestion des commentaires</p>
       </div>";
    }
    }

    
   
  ?>
    <form class="box" action="" method="post" align="center">
      <h1 class="box-logo box-title"></h1>
      <h1 class="box-title">Add comment</h1>
      <div>
      <textarea class="box-input" name="contenu" rows="5" cols="25"/></textarea>
      </div>
      <div>
        <select name="id_user" style="width: 200px; height: 30px; margin-top:10px">
        <?php while ($users = $select->fetch(PDO::FETCH_ASSOC)) : ?>
          <option value="<?=$users['id']?>"><?=$users['login'];?></option>
        <?php endwhile; ?>
        </select>
      
      </div>
      <div><input type="submit" name="submit" value="Envoyer" class="box-button" /></div>
    </form>

</body>

</html>