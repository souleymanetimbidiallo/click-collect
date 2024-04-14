<?php 
require("../../config.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
$conn = connexion();
$sql = "SELECT * FROM personne WHERE id = :id";

$select = $conn->prepare($sql);
$select->bindParam(':id', $id);

$select->execute();
$user = $select->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
</head>

<body>
    <table border=1>
        <tr>
            <th>ID</th>
            <td><?= $user['id'] ?></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><?= $user['nom'] ?></td>
        </tr>
        <tr>
            <th>Prénom</th>
            <td><?= $user['prenom'] ?></td>
        </tr>
        <tr>
            <th>Login</th>
            <td><?= $user['login'] ?></td>
        </tr>
        <tr>
            <th>Type</th>
            <td><?= $user['type'] ?></td>
        </tr>
    </table>
    <p><a href="index.php">Retour</a></p>
</body>

</html>
<?php
}
?>