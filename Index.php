<?php
require("Connexiondb.php");
session_start();
session_destroy();
if (isset($_POST["done"])) {
    extract($_POST);
    $sql = $db->prepare("SELECT * FROM user WHERE Login=? AND Pass=?");
    $sql->execute([$login, $pass]);
    $data = $sql->fetch();
    if (empty($data)) {
        $Error = "INCORRECT LOGIN OR PASS";
    } else {
        session_start();
        $_SESSION['data'] = $data;
        if ($data['Type'] == "Admin") {
            if ($data['Pass'] == "admin") {
                header("location:ModifierPass.php");
            } else {
                header("location:Admin/Profile.php?id=" . $data['idUser']);
            }
        } else if ($data['Type'] == "Etudient") {
            if ($data['Pass'] == "Etudient") {
                header("location:ModifierPass.php");
            } else {
            header("location:Etudient/Profile.php?id=" . $data['idUser']);}
        }
        if ($data['Type'] == "Formateur") {
            if ($data['Pass'] == "Formateur") {
                header("location:ModifierPass.php");
            } else {
            header("location:Formateur/Profile.php?id=" . $data['idUser']);}
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGN</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body class="container pt-3">
    <form method="post" action="#" class="form col-6">
        <div style="height: 60px;">
            <?php if (isset($Error)) {
                echo ('<p class="alert alert-danger">' . $Error . '</p>');
            }
            ?>

        </div>
        <h1>LOGIN:</h1>
        <p>Email:
            <input class="form-control  " type="text" name="login" placeholder="email">
        </p>
        <p>Mot De Pass:
            <input class="form-control  " type="text" name="pass" placeholder="mot de pass">
        </p>
        <p><a href="" class="link link-primary">oublier mot de pass?</a></p>
        <button type="submit" class="btn btn-primary" name="done">LOGIN</button>
    </form>
</body>

</html>