<?php
require("../../config.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn = connexion();
    $sql = "DELETE FROM commentaire WHERE id_com = :id";

    $delete = $conn->prepare($sql);
    $delete->bindParam(':id', $id);

    $delete->execute();

    if($delete->rowCount() != 0){
        header("Location: index.php");
    }
}
?>