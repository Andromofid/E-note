<?php
require("../Connexiondb.php");
session_start();
if (!isset($_SESSION['data'])) {
    header("location:../../Index.php");
} else {
    $data = $_SESSION['data'];
    $sql = $db->prepare("SELECT * FROM user U JOIN etudient E ON U.idUser = E.IdUser JOIN groupe G ON E.IdGroup = G.IdGroup WHERE U.idUser=?");
    $sql->execute([$data['idUser']]);
    $etudient = $sql->fetch();
    $sql = $db->prepare("SELECT * FROM module WHERE Anne =?");
    $sql->execute([$etudient['Anne']]);
    $modules = $sql->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGN</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
    <style>
        td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div>
        <div class="container">
            <div class="row justify-content-between my-3">
                <h3 class="col-2">E-note</h3>
                <ul class="nav col-6 ">
                    <li class="mx-2"><a href="">Profile</a></li>
                    <li class="mx-2"><a href="">Emploit</a></li>
                    <li class="mx-2"><a href="">Notes</a></li>
                    <li class="mx-2"><a href="">Autres</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container ">
        <div class="row my-3">
            <table class="table  ">
                <tr>
                    <td colspan="1">
                    </td>
                    <td>Nom</td>
                    <td>Prenom</td>
                    <td>Anne</td>
                    <td>Groupe</td>
                    <td>Emploite</td>
                </tr>
                <tr>
                    <td>
                        <div style="height: 100px;width:100px;border-radius:50%;" class="bg-dark col-2 ">
                        </div>
                    </td>
                    <td class=""><?= $etudient['Nom'] ?></td>
                    <td class=""><?= $etudient['Prenom'] ?></td>
                    <td class=""><?= $etudient['Anne'] ?></td>
                    <td class=""><?= $etudient['NomGroup'] ?></td>
                    <td class=""><a href=""><?= $etudient['Emploit'] ?></a></td>
                </tr>
            </table>
        </div>
        <div class="row">
            <ul class="list-group  w-50" >
                <li class="list-group-item list-group-item-dark fs-4">List des groupes: </li>
                <?php
                foreach ($modules as $module) {
                ?>
                    <li class="list-group-item list-group-item-dark"> <?= $module['NomM'] ?></li>
                <?php
                }
                ?>
            </ul>
            <div class="col-6 d-flex  align-items-center  justify-content-center fs-5">
                <h1>Image</h1>
            </div>
        </div>
    </div>
</body>

</html>