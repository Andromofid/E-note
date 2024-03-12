<?php
require("../Connexiondb.php");
session_start();
if (!isset($_SESSION['data'])) {
    header("location:../Index.php");
} else {
    $data = $_SESSION['data'];
    $sql = $db->prepare("SELECT * FROM user WHERE idUser = ?");
    $sql->execute([$data["idUser"]]);
    $user = $sql->fetch();
    if (isset($_POST["done"])) {
        extract($_POST);
        if ($_POST["oldpass"] != $user['Pass']) {
            $Error = "border-danger";
        } elseif ($_POST["newpass"] != $_POST["confirmpass"]) {
            $Error1 = "border-danger";
        } elseif ($_POST["oldpass"] == $user['Pass']) {
            $sql = $db->prepare("UPDATE user SET Pass = ? WHERE idUser = ? ");
            $sql->execute([$confirmpass, $data["idUser"]]);
            header("location:Profile.php?done=Terminer Avec Succes");
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
    <link rel="stylesheet" href="../bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row align-items-center">
            <h1 class="col-2">SGN</h1>
            <ul class="nav col-10">
                <li class="mx-2">
                    <a href="">Profile</a>
                </li>
                <li class="mx-2">
                    <a href="Etudient/AjouterEtudient.php">Ajouter Etudient</a>
                </li>

                <li class="mx-2">
                    <a href="Group/Groupes.php">List De Groupes</a>
                </li>
                <li class="mx-2">
                    <a href="">List De Formateur</a>
                </li>
                <li class="mx-2">
                    <a href="<?php session_destroy(); ?>">Deconnecter</a>
                </li>
            </ul>
        </div>
    </div>

    <form action="#" method="post" class="form w-50 p-3">
        <h1>Modifier Votre Profile</h1>
        <p>
            Votre Mot De Pass :
            <input required class="form-control <?php if (isset($Error)) {
                                                    echo ($Error);
                                                } ?>" type="text" name="oldpass">
        </p>
        <p>
            Noveau Mot De Pass :
            <input required class="form-control <?php if (isset($Error1)) {
                                                    echo ($Error1);
                                                } ?>" type="text" name="newpass">
        </p>
        <p>
            Confirmer le Mot De Pass :
            <input required class="form-control <?php if (isset($Error1)) {
                                                    echo ($Error1);
                                                } ?>" type="text" name="confirmpass">
        </p>
        <button class="btn btn-primary" name="done">Modifier</button>
    </form>
</body>

</html>