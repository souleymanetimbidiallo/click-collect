<?php
    require('config.php');
    if(isset($_POST['submit'])){
        $connexion = connexion();
            $sql = "SELECT * 
                    FROM personne
                    WHERE login = :login";
      
            $select = $connexion->prepare($sql);
            var_dump("ok");die();
        
            $select->bindParam(":login", $login);
            $login = $_POST['login'];

            $select->execute();
            if($select->rowCount() != 0){
                $user = $select->fetch(PDO::FETCH_ASSOC);
                header("Location: update_password.php?id=".$user['id']);
            }else{
                $message = "Le login entré n'existe pas!";
            }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Mot de passe oublié?</h1>
    <form action="" post="POST">
        <label for="email">Veuillez entrer votre login</label>
        <div>
            <input type="text" name="login" id="email">
        </div>
        <div>
            <input type="submit" name="submit" value="Envoyer">
        </div>
    </form>
    
    <?php 
        if(isset($message)){
            echo $message;
        }
    ?>
</body>
</html>