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
    
    $sql = "SELECT * FROM personne WHERE id = :id";
    
    $select = $connexion->prepare($sql);
    $select->bindParam(':id', $id);
    
    $select->execute();
    $user = $select->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['login'], $_POST['password'])) {
        $sql = "UPDATE `personne` 
                SET nom = :nom, prenom = :prenom, login = :login , type = :type, password = :password
                WHERE id = :id";
    
        $edit = $connexion->prepare($sql);
    
        $edit->bindParam(":nom", $nom);
        $edit->bindParam(":prenom", $prenom);
        $edit->bindParam(":login", $login);
        $edit->bindParam(":password", $password);
        $edit->bindParam(":type", $type);
        $edit->bindParam(":id", $id);
    
        
        
        // récupérer le login 
        $login = secure($_POST['login']);
        
        // récupérer le nom 
        $nom = secure($_POST['nom']);
    
        // récupérer le prenom 
        $prenom = secure($_POST['prenom']);
        
        // récupérer le mot de passe
        $password = hash('sha256', secure($_POST['password']));
    
        // récupérer le type d'utilisateur 
        $type = secure($_POST['type']);
    
        $edit->execute();

        if($edit->rowCount() != 0){
            header("Location: index.php");
        }


    }
  ?>
    <form class="box" action="" method="post" align="center">
      <h1 class="box-logo box-title"></h1>
      <h1 class="box-title">Edit User N°<?=$id?></h1>
      <div>
      <input type="text" class="box-input" name="nom" placeholder="Nom" required  value="<?=$user['nom']?>" /></div>
      <div><input type="text" class="box-input" name="prenom" placeholder="prenom " required value="<?=$user['prenom']?>"/></div>
      <div> <input type="text" class="box-input" name="login" placeholder="login" required value="<?=$user['login']?>"/>
      </div>

      <div>
        <select class="box-input" name="type" id="type">
          <option value="admin">Admin</option>
          <option value="marchand">Marchand</option>
          <option value="user">Client</option>
        </select>
      </div>


      <div><input type="password" class="box-input" name="password" placeholder="Mot de passe" required /></div>
      <div> <input type="submit" name="submit" value="Modifier" class="box-button" /></div>
    </form>
  <?php 
  }

  ?>
</body>

</html>