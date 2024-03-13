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
    $sql = $db->prepare("SELECT * FROM passerexam P join exam E on P.IdExam = E.IdExam Join module M ON M.IdModule = E.IdModule where P.IdEtud =?  limit 4");
    $sql->execute([$etudient['IdEtud']]);
    $notes = $sql->fetchAll();
    $dataPoints = array();
    foreach($notes as $notes){
        array_push($dataPoints, array("y" => $notes['Note'], "label" =>$notes['NomM'] ));

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
    <style>
        td {
            vertical-align: middle;
        }
    </style>
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: ""
                },
                axisY: {
                    title: "note/20 "
                },
                axisX: {
                    title: "Modules"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0.##/20",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
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
            <ul class="list-group  w-50">
                <li class="list-group-item list-group-item-dark fs-4">List des Modules: </li>
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
    <hr width="90%" class="mx-auto mt-5">
    <div class="container-fluid">
        <h3 class="text-center mt-4">graph des derniere notes</h3>
        <div id="chartContainer" style="height: 370px" class="w-75 my-5 mx-auto" ></div>
    </div>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

</body>

</html>