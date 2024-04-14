<?php
session_start();
  
require('../../config.php');

if(isset($_POST['comment'])){
    $conn = connexion();
    $sql = "INSERT into `commentaire` (contenu, id_user, id_eta)
            VALUES (:contenu, :id_user, :id_eta)";

    $insert = $conn->prepare($sql);

    $insert->bindParam(":contenu", $contenu);
    $insert->bindParam(":id_user", $id_user);
    $insert->bindParam(":id_eta", $id_eta);
    

    // récupérer le contenu
    $contenu = secure($_POST['contenu']);

    $id_user = secure($_SESSION['id']);

    $id_eta = secure($_GET['id']);

    $insert->execute();

    if ($insert->rowCount() != 0) {
      header("Location: show.php?id=".$_GET['id']);
    }
}
