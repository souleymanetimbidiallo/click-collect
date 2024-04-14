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
    <p>C'est votre espace administrateur. <a href="../logout.php">Deconnexion</a></p>
    <h2><a href="users/index.php">Gestion des utilisateurs</a></h2>
    <h2><a href="comments/index.php">Gestion des commentaires</a></h2>
    <h2><a href="type_category/index.php">Gestion des types de catégorie</a></h2>
    <h2><a href="type_product/index.php">Gestion des types de produit</a></h2>
    </div>
  </body>
</html>