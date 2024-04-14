<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php
  session_start();
  // connexion avec le login et le mot de passe en autorisant l'accès.
  require('config.php');

  
  if (isset($_POST['submit'])) {
    if(isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['password']) && !empty($_POST['password'])){
      $conn = connexion();
      
      $login = secure($_POST['login']);
      $password = hash('sha256', secure($_POST['password']));

      $sql = "SELECT * FROM personne WHERE login = :login and password = :password";
  
      $select = $conn->prepare($sql);

      $select->bindParam(":login", $login);
      $select->bindParam(":password", $password);
  
      $select->execute();
  
      if ($select->rowCount() != 0) {
          $user = $select->fetch();
          $_SESSION['id'] = $user['id'];
          $_SESSION['login'] = $login;
          if($user['type']=='admin'){
            header('Location: admin/home.php');
        } 
        elseif($user['type']=='user') {
          header("Location: profil.php");
        }
        elseif($user['type']=='marchand'){
          header("location: marchand/index.php");
        }
      }else {
        $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
      }
    }else{
      $message = "Veuillez remplir les champs";
    }
    
  }
  ?>
  <form class="box" action="" method="post" name="login" align="center">
    <h1 class="box-logo box-title"></h1>
    <h1 class="box-title">Connexion</h1>
    <div><input type="text" class="box-input" name="login" placeholder="login"></div>
    <div><input type="password" class="box-input" name="password" placeholder="Mot de passe"></div>
    <div><input type="submit" value="Connexion " name="submit" class="box-button"></div>
    <p><a href="password_forget.php">Mot de passe oublié ?</a></p>
    <p class="box-register">Vous etes nouveau ici ?
      <a href="register.php">S'inscrire</a>
    </p>
    <?php if (!empty($message)) { ?>
      <p class="errorMessage"><?php echo $message; ?></p>
    <?php } ?>
  </form>
</body>

</html>