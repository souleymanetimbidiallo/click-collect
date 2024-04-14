<?php
    require('../../config.php');
    $conn = connexion();

    
    $sql1  = "SELECT * FROM photo
              WHERE id_eta = :id_eta";

    $select = $conn->prepare($sql1);
    $select->bindParam(':id_eta', $_GET['id']);
    $select->execute();


    if(isset($_POST['submit']) && isset($_GET['id'])){
        $message = uploadPicture($_FILES['photo']);
        if(empty($message)){
            $sql = "INSERT into photo (emplacement, nom, id_eta)
            VALUES (:emplacement, :nom, :id_eta)";
            $insert = $conn->prepare($sql);
            $insert->bindParam(":emplacement", $emplacement);
            $insert->bindParam(":nom", $nom);
            $insert->bindParam(":id_eta", $id_eta);
            
            
            $emplacement = secure($_FILES['photo']['name']);
            $nom = secure($_FILES['photo']['name']);
            $id_eta = secure($_GET['id']);

            $insert->execute();

            if ($insert->rowCount() != 0) {
            echo "<div class='success'>
                    <h3>Photo ajouté avec succès.</h3>
                    <p>Cliquez <a href='index.php'>ici</a>pour gérer votre établissement</p>
            </div>";
            }
        }else{
            die($message);
        }


        
    }
    
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes photos</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <h1>Ajouter des photos de votre établissement</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <input type="file" name="photo" id="">
        </div>
        <div>
            <input type="submit" name="submit" value="Ajouter">
        </div>
    </form>
    <hr>
    <table>
        <tr>
            <?php while($photo = $select->fetch(PDO::FETCH_ASSOC)): ?>
            <td><img style="width:250px; height:200px" src="../../images/etablissements/<?=$photo['nom']?>" alt=""></td>
            <?php endwhile; ?>
        </tr>
    </table>
</body>
</html>