<?php
require("../../Connexiondb.php");
session_start();
if (!isset($_SESSION['data'])) {
    header("location:../../Index.php");
} else {
    extract($_GET);
    $sql = $db->prepare("SELECT * FROM groupe WHERE idGroup=?");
    $sql->execute([$idGroup]);
    $Group = $sql->fetch();
    if (isset($_POST["done"])) {
        extract($_POST);
        $sql = $db->prepare("UPDATE groupe SET NomGroup = ? ,Anne=? , Emploit =? WHERE idGroup=?");
        $sql->execute([$NomGroup, $Anne, $Emploit, $idGroup]);
        header("location:Groupes.php?done=Terminer avec Success");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGN</title>
    <link rel="stylesheet" href="../../bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row align-items-center">
            <h1 class="col-2">SGN</h1>
            <ul class="nav col-10">
                <li class="mx-2">
                    <a href="../Profile.php">Profile</a>
                </li>
                <li class="mx-2">
                    <a href="../Etudient/AjouterEtudient.php">Ajouter Etudient</a>
                </li>
                <li class="mx-2">
                    <a href="./Groupes.php">List De Groupes</a>
                </li>
                <li class="mx-2">
                    <a href="">List De Formateur</a>
                </li>
                <li class="mx-2">
                <a href="<?php session_destroy();?>">Deconnecter</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <form action=" " method="post" class="col-5">

                <h1 class="py-3">Modifier Groupes</h1>
                <p>
                    Nom :
                    <input type="text" class="form-control" name="NomGroup" placeholder="NomGroup" value=<?= $Group['NomGroup'] ?>>
                </p>
                <p>
                    <select name="Anne" id="" class="form-select">
                        <option value=<?= $Group['Anne'] ?>><?= $Group['Anne'] ?></option>
                        <option value="A1">1 Anne</option>
                        <option value="A2">2 Anne</option>
                    </select>
                </p>
                <p>
                    Emploit:
                    <input type="text" name="Emploit" class="form-control" placeholder="Emploit" value=<?= $Group['Emploit'] ?>>
                </p>
                <p>
                    <button class="btn btn-primary" name="done">Modifier</button>
                </p>
            </form>
        </div>
    </div>

</body>

</html>