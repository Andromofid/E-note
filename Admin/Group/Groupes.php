<?php
require("../../Connexiondb.php");
session_start();
if (!isset($_SESSION['data'])) {
    header("location:../../Index.php");
} else {
    $data = $_SESSION['data'];
    $sql = $db->prepare("SELECT * FROM groupe ORDER BY NomGroup ASC ");
    $sql->execute([]);
    $Groupes = $sql->fetchAll();
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
                    <a href="./Groupes.php ">List De Groupes</a>
                </li>
                <li class="mx-2">
                    <a href="">List De Formateur</a>
                </li>
                <li class="mx-2">
                <a href="<?php session_destroy();?>">Deconnecter</a>
                </li>
            </ul>
        </div>
        <a href="AjouterGroup.php" class="btn btn-primary my-2" style="float: right;">Ajouter Un Group</a>
        <table class="table table-striped table-hovered mt-3">
            <tr>
                <th>Id De Groupe</th>
                <th>Nom De Groupe</th>
                <th>Anne</th>
                <th>Emploit De Groupe</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            if (isset($Groupes)) {
                foreach ($Groupes as $Groupe) {
                    ?>
                    <tr>
                        <td><?=$Groupe["IdGroup"] ?></td>
                        <td><a  href="../Etudient/Etudients.php?idGroup=<?= $Groupe['IdGroup']?>"><?=$Groupe['NomGroup'] ?></a></td>
                        <td><?= $Groupe['Anne']?></td><td><a  href=""><?= $Groupe['Emploit']  ?></a></td>
                        <td><a  href="ModifierGroup.php?idGroup=<?= $Groupe['IdGroup']?>" class="btn btn-warning">Modifier</a></td>
                        <td><a href="Supprimer.php?idGroup=<?= $Groupe['IdGroup']?>"  class="btn btn-danger" >Supprimer</a></td>
                    </tr><?php
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