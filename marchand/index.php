<?php
// page admin
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["login"])){
    header("Location: ../login.php");
    exit(); 
  }
?>
<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="../style.css" />
  <meta charset="utf-8"> 
  </head>
  <body>
    <div class="sucess">
    <h1>Bienvenue <?php echo $_SESSION['login']; ?>!</h1>
    <p>C'est votre espace marchand. <a href="../logout.php">Déconnexion</a></p>

    <h2><a href="etablissements/index.php"> Gestion des établissements</a></h2>
    </div>
  </body>
</html>