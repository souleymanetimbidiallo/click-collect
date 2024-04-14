<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
<meta charset='utf-8'>
</head>
<body>
<?php
//création d'un formulaire web qui permet aux utilisateurs de s’inscrire.
require('config.php');

if (isset($_REQUEST['login'], $_REQUEST['password'])){
  $conn = connexion();

  $sql = "INSERT into `personne` (nom, prenom, login, type, password)
          VALUES (:nom, :prenom,:login, 'user', :password)";

$insert = $conn->prepare($sql);

$insert->bindParam(":nom", $nom);
$insert->bindParam(":prenom", $prenom);
$insert->bindParam(":login", $login);
$insert->bindParam(":password", $password);

// récupérer le login 
$login = secure($_POST['login']);

// récupérer le nom 
$nom = secure($_POST['nom']);

// récupérer le prenom 
$prenom = secure($_POST['prenom']);

// récupérer le mot de passe
$password = hash('sha256', secure($_POST['password']));

$insert->execute();

    if($insert->rowCount() != 0){
       echo "<div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
       </div>";
    }
}else{
?>
<p>Si vous êtes marchand, cliquez <a href="marchand/register.php">ici</a></p>
<form class="box" action="" method="post" align="centers">
    <h1 class="box-title">S'inscrire</h1>
    <div><input type="text" class="box-input" name="nom" placeholder="Nom" required /></div>
    <div><input type="text" class="box-input" name="prenom" placeholder="prenom " required /></div>
    <div><input type="text" class="box-input" name="login" placeholder="login" required /></div>
    <div><input type="password" class="box-input" name="password" placeholder="Mot de passe" required /></div>
    <div><input type="submit" name="submit" value="S'inscrire" class="box-button" /></div>
    <p class="box-register">Deja inscrit? 
  <a href="login.php">Connectez-vous ici</a></p>
</form>
<?php } ?>
</body>
</html>