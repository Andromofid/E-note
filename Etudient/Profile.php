<?php
require("../Connexiondb.php");
session_start();
if (!isset($_SESSION['data'])) {
    header("location:../../Index.php");
} else {
    $data = $_SESSION['data'];
    $sql = $db->prepare("SELECT * FROM user WHERE idUser=?");
    $sql->execute([$data['idUser']]);
    $etudient = $sql->fetch();

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGN</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
</head>

<body>
    <h1><?= $etudient['Nom']?></h1>
</body>
</html>