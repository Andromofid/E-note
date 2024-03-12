<?php
require("../../Connexiondb.php");
session_start();
if (!isset($_SESSION['data'])) {
    header("location:../../Index.php");
} else {
    $data = $_SESSION['data'];
    $sql = $db->prepare("SELECT * FROM groupe ");
    $sql->execute();
    $Groupes = $sql->fetchAll();
    if(isset($_POST['done'])){
        extract($_POST);
            $sql = $db->prepare("CALL AjouterUser(?,?,?,?,?)");
            $sql->execute([$NomEtudient,$PrenomEtudien,$Login,$Pass,"Etudient"]);
            $sql = $db->prepare("CALL AjouterEtudient(?)");
            $sql->execute([$Groupe]);
            header("location:../Group/Groupes.php?done=Succes");
    
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
                    <a href="Groupes.php">List De Groupes</a>
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
            <form action="" method="post" class="col-5">
                <h1 class="py-3">Ajouter Etudient :</h1> 
                <p>
                    Nom :
                     <input type="text" class="form-control" name="NomEtudient" placeholder="Nom">
                </p>
                <p>
                    Prenom :
                     <input type="text" class="form-control" name="PrenomEtudien" placeholder="Prenom">
                </p>
                <p>
                <select name="Groupe" id=""  class="form-select">

                    <?php
                    foreach($Groupes as $groupe){
                     ?>
                        <option value="<?= $groupe["IdGroup"] ?>" ><?= $groupe["NomGroup"] ?></option>
                        <?php  }?>
                    </select>
                </p>
                <p>
                    Login:
                    <input type="text" name="Login"  class="form-control" placeholder="Emploit">
                </p>
                <p>
                    Mot de pass:
                    <input type="text" name="Pass"  class="form-control" placeholder="Emploit">
                </p>
                <p>
                    <button class="btn btn-primary" name="done">Ajouter</button>
                </p>
            </form>
        </div>
    </div>

</body>

</html>