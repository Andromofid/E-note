<?php
require("Connexiondb.php");
session_start();
if (!isset($_SESSION['data'])) {
    header("location:../../Index.php");
} else if (isset($_POST["done"])) {
    extract($_POST);
    if ($newpass == $Confirmpass) {
        $sql = $db->prepare("UPDATE user SET Pass = ? WHERE idUser = ?");
        $sql->execute([$Confirmpass, $_SESSION["data"]["idUser"]]);
        switch ($_SESSION['data']['Type']) {
            case 'Admin':
                header("location:Admin/Profile.php?id=" . $data['idUser']);
                break;
            case 'Etudient':
                header("location:Etudient/Profile.php?id=" . $data['idUser']);
                break;
            default:
                header("location:Formateur/Profile.php?id=" . $data['idUser']);
                break;
        }
    } else {
        $Error = "INCORRECT LOGIN OR PASS";
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
    <form method="post" action="" class="form col-7">
        <h1>Changer votre mot de pass :</h1>
        <div style="height: 60px;">
            <?php if (isset($Error)) {
                echo ('<p class="alert alert-danger">' . $Error . '</p>');
            }
            ?>

        </div>

        <p>Nouveau mot de pass:
            <input class="form-control  " type="text" name="newpass" placeholder="Nouveau mot de pass">
        </p>
        <p>Mot De Pass:
            <input class="form-control  " type="text" name="Confirmpass" placeholder="Confirmer le mot de pass">
        </p>
        <button type="submit" class="btn btn-primary" name="done">Valider</button>
        <?php
        switch ($_SESSION['data']['Type']) {
            case 'Admin':?>
                <a href="Admin/Profile.php" class="mx-2">Ignorer</a>
            <?php break; case 'Etudient': ?>
                <a href="Etudient/Profile.php" class="mx-2">Ignorer</a>
            <?php break;default:?>
                <a href="Formateur/Profile.php" class="mx-2">Ignorer</a>
            <?php break;
            }
        ?>
    </form>
</body>

</html>