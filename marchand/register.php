<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" href="style.css" />
        <meta charset='utf-8'>
    </head>

    <body>
        <?php
        //création d'un formulaire web qui permet aux utilisateurs de s’inscrire.
        require('../config.php');
        $message = "";

        if (isset($_POST['submit'])) {
            $conn = connexion();

            $sql = "INSERT into `personne` (nom, prenom, login, type, password)
            VALUES (:nom, :prenom,:login, 'marchand', :password)";

            $insert = $conn->prepare($sql);

            $insert->bindParam(":nom", $nom);
            $insert->bindParam(":prenom", $prenom);
            $insert->bindParam(":login", $login);
            $insert->bindParam(":password", $password);

            $login = secure($_POST['login']);

            $nom = secure($_POST['nom']);

            $prenom = secure($_POST['prenom']);

            if(strlen($_POST['password']) < 4){
                $message = "Erreur. Veuillez saisir 4 caractères minimum pour le mot de passe";
            }else{
                $password = hash('sha256', secure($_POST['password']));
                $insert->execute();
                if ($insert->rowCount() != 0) {
                    $_SESSION['login'] = $login;
                    echo "<div class='sucess'>
                    <h3>Vous êtes inscrit avec succès.</h3>
                    <p>Cliquez ici pour vous <a href='../login.php'>connecter</a></p>
                    </div>";
                }
            }


            
        } else {
        ?>
            <form class="box" action="" method="post" align="centers">
                <h1 class="box-title">S'inscrire | Marchand</h1>
                <div><input type="text" class="box-input" name="nom" placeholder="Nom" required /></div>
                <div><input type="text" class="box-input" name="prenom" placeholder="prenom " /></div>
                <div><input type="text" class="box-input" name="login" placeholder="login" required /></div>
                <div><input type="password" class="box-input" name="password" placeholder="Mot de passe" required /></div>
                
                <div><input type="text" class="box-input" name="" placeholder="login" required /></div>
                <div><input type="submit" name="submit" value="S'inscrire" class="box-button" /></div>
                <p class="box-register">Deja inscrit?
                    <a href="login.php">Connectez-vous ici</a>
                </p>
                <?php if (!empty($message)) { ?>
                    <p class="errorMessage"><?php echo $message; ?></p>
                <?php } ?>
            </form>
        <?php } ?>
    </body>

    </html>