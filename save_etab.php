<?php
    session_start();
    require('config.php');    
    if(isset($_GET['id'])){
        $conn = connexion();
        $sql = "INSERT into favori (id_user, id_eta)
                VALUES (:id_user, :id_eta)";

        $insert = $conn->prepare($sql);

        $insert->bindParam(":id_user", $id_user);
        $insert->bindParam(":id_eta", $id_eta);

        $id_user = $_SESSION['id'];
        $id_eta = $_GET['id'];

        $insert->execute();

        if($insert->rowCount() != 0){
           header("Location: index.php"); 
        }else{
            echo "Erreur d'ajout de favori";
        }

    }
?>