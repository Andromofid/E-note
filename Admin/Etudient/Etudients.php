<?php
require("../../Connexiondb.php");
session_start();
if (!isset($_SESSION['data'])) {
    header("location:../../Index.php");
} else {
    $data = $_SESSION['data'];

    if (isset($_GET['idGroup'])) {
        $sql = $db->prepare("SELECT * FROM  etudient E Join user U  ON E.IdUser = U.idUser WHERE E.IdGroup = ? ");
        $sql->execute([$_GET['idGroup']]);
        $etudients = $sql->fetchAll();
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
                    <a href="AjouterEtudient.php">Ajouter Etudient</a>
                </li>

                <li class="mx-2">
                    <a href="../Group/Groupes.php ">List De Groupes</a>
                </li>
                <li class="mx-2">
                    <a href="">List De Formateur</a>
                </li>
                <li class="mx-2">
                <a href="<?php session_destroy();?>">Deconnecter</a>
                </li>
            </ul>
        </div>
        <a href="AjouterEtudient.php" class="btn btn-primary my-2" style="float: right;">Ajouter Un etudient</a>
        <table class="table table-striped table-hovered mt-3">
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Login</th>
                <th>Pass</th>
                <th></th>
            </tr>
            <?php
            if (isset($etudients)) {
                foreach ($etudients as $etudient) {
            ?>
                    <tr>
                        <td><?= $etudient["Nom"]?></td>
                        <td><?= $etudient['Prenom']?></td>
                        <td><?= $etudient['Login']?></td>
                        <td ><?= $etudient['Pass']?></td>
                        <td><a  href="ModifierEtudient.php?IdUser=<?= $etudient["idUser"] ?>" class="btn btn-warning">Modifier</a></td>
                    </tr>
            <?php
                }
            }
            ?>

        </table>
    </div>
    <?php
    if (isset($_GET['done'])) {
        echo ("<p style='position:fixed;right:5px;bottom:5px;' class='alert alert-success w-25'>" . $_GET['done'] . "</p>");
    }

    ?>

</body>

</html>