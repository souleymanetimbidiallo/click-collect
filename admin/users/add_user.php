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
  
  if (isset($_POST['login'], $_POST['password'])) {
    $conn = connexion();

    $sql = "INSERT into `personne` (nom, prenom, login, type, password)
            VALUES (:nom, :prenom,:login, :type, :password)";

    $insert = $conn->prepare($sql);

    $insert->bindParam(":nom", $nom);
    $insert->bindParam(":prenom", $prenom);
    $insert->bindParam(":login", $login);
    $insert->bindParam(":password", $password);
    $insert->bindParam(":type", $type);

    
    
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

    $insert->execute();

    if ($insert->rowCount() != 0) {
      echo "<div class='sucess'>
             <h3>L'utilisateur a été crée avec succès.</h3>
             <p>Cliquez <a href='index.php'>ici</a>Gestion des utilisateurs</p>
       </div>";
    }
  } else {
  ?>
    <form class="box" action="" method="post" align="center">
      <h1 class="box-logo box-title"></h1>
      <h1 class="box-title">Add user</h1>
      <div><input type="text" class="box-input" name="nom" placeholder="Nom" required /></div>
      <div><input type="text" class="box-input" name="prenom" placeholder="prenom " required /></div>
      <div> <input type="text" class="box-input" name="login" placeholder="login" required /></div>

      <div>
        <select class="box-input" name="type" id="type">
          <option value="admin">Admin</option>
          <option value="marchand">Marchand</option>
          <option value="user">Client</option>
        </select>
      </div>


      <div><input type="password" class="box-input" name="password" placeholder="Mot de passe" required /></div>
      <div> <input type="submit" name="submit" value="+ Ajouter" class="box-button" /></div>
    </form>
  <?php }


  ?>
</body>

</html>