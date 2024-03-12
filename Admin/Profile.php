<?php
require("../Connexiondb.php");
session_start();
if (!isset($_SESSION['data'])) {
    header("location:../../Index.php");
} else {
    if ($_SESSION['data']['Type'] == "Admin") {
        $data = $_SESSION['data'];
        $sql = $db->prepare("SELECT * FROM Groupe limit 3");
        $sql->execute([]);
        $Groupes = $sql->fetchAll();

        $sql = $db->prepare("SELECT * From user Where Type = ? limit 3");
        $sql->execute(["Formateur"]);
        $Formateurs = $sql->fetchAll();
    }else{
    header("location:../../Index.php");
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
    <div class="container">
        <h3 class="my-3">Bonjour <?= $data['Nom'] ?>!</h3>
        <div class="row">
            <table class="table w-100 my-3 table-striped ">
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <?= $data['Nom'] ?>
                    </td>
                    <td>
                        <?= $data['Prenom'] ?>
                    </td>
                    <td>
                        <?= $data['Login'] ?>
                    </td>
                    <td>
                        <?= $data['Type'] ?>
                    </td>
                    <td>
                        <a href='ModifierPass.php'>Changer Le Mot De Pass</a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row">
            <a href="../Etudient"></a>
            <ul class="list-group col-5">
                <p class=""> List De Groupes:</p>
                <?php
                foreach ($Groupes as $Groupe) {
                    echo ('<li class="list-group-item list-group-item-primary "><a href="Etudient/Etudients.php?idGroup=' . $Groupe["IdGroup"] . '" class="text-dark">' . $Groupe['NomGroup'] . '</a></li>');
                }
                ?>
                <li class="list-group-item list-group-item-primary "><a href="./Group/Groupes.php" class="text-primary">Plus de Groupes</a></li>
            </ul>
            <ul class="list-group col-5">
                <p class=""> List De Formateurs:</p>
                <?php
                foreach ($Formateurs as $Formateur) {
                    echo ('<li class="list-group-item list-group-item-primary "><a href="" class="text-dark">' . $Formateur['Nom'] . $Formateur['Prenom'] . '</a></li>');
                }
                ?>

                <li class="list-group-item list-group-item-primary "><a href="" class="text-prmary">Plus de Formateurs</a></li>
            </ul>
        </div>
    </div>
    <?php
    if (isset($_GET['done'])) {
        echo ("<p style='position:fixed;right:5px;bottom:5px;' class='alert alert-success w-25'>" . $_GET['done'] . "</p>");
    }

    ?>
</body>

</html>