<?php
    require('config.php');
      
    $connexion = connexion();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        if (isset($_POST['pass1'], $_POST['pass2'])) {
            $sql = "UPDATE `personne` 
                  SET password = :password
                  WHERE id = :id";
      
            $edit = $connexion->prepare($sql);
        
            $edit->bindParam(":password", $password);
            $edit->bindParam(":id", $id);
        
        
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            if($pass1 !== $pass2){
                $message = "Les mots de passe doivent être identiques";
            }else{
                $password = hash('sha256', secure($_POST['pass1']));
                $edit->execute();
                if($edit->rowCount() != 0){
                    header("Location: index.php");
                }
            }
            
        }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changez le mot de passe</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Changez le mot de passe</h1>
    <form action="" method="POST">
        <div>
            <input type="password" name="pass1" id="" placeholder="Mot de passe">
        </div>
        <div>
            <input type="password" name="pass2" id="" placeholder="Confirmer le mot de passe">
        </div>
        <div>
            <input type="submit" name="submit" value="Modifier">
        </div>
    </form>
    <?php 
        if(isset($message)){
            echo $message;
        }
    ?>
</body>
</html>
<?php
}
?>