<?php
require("../../Connexiondb.php");
session_start();
if (!isset($_SESSION['data'])) {
    header("location:../../Index.php");
} else {
    extract($_GET);
    // SELECT STUDENT'S INFO  :
    $sql = $db->prepare("SELECT * FROM User U JOIN etudient E ON U.idUser = E.IdUser JOIN groupe G ON E.IdGroup = G.IdGroup  WHERE U.idUser=?");
    $sql->execute([$IdUser]);
    $Etudient = $sql->fetch();
    // SELECT ALL GROUPES FOR UPDATING  THE GROUP OF THE STUDIENT :
    $sql = $db->prepare("SELECT * FROM groupe");
    $sql->execute([]);
    $Groupes = $sql->fetchAll();
    // AFTER CLICK ON SUBMIT :
    if (isset($_POST["done"])) {
        extract($_POST);
        // UPDATE THE FULL NAME OR LOGIN OR PASS :
        $sql = $db->prepare("UPDATE user SET Nom = ? ,Prenom=? , Login =?, Pass=? WHERE idUser=?");
        $sql->execute([$Nom,$Prenom,$Login,$Pass,$IdUser]);
        // UPDATE THE GROUP:
        $sql = $db->prepare("UPDATE etudient SET IdGroup = ? WHERE IdUser=?");
        $sql->execute([$Groupe,$IdUser]);
        // RETURN THE LIST OF STUDIENT WITH MESSAGE "TERMINER AVEC SUCCESS ":
        header("location:Etudients.php?idGroup=".$Etudient['IdGroup']."&done=Terminer avec Success");
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
                    <a href="../../Profile.php">Profile</a>
                </li>
                <li class="mx-2">
                    <a href="AjouterEtudient.php">Ajouter Etudient</a>
                </li>

                <li class="mx-2">
                    <a href="../Group/Groupes.php">List De Groupes</a>
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

                <h1 class="py-3">Modifier Etudient:</h1>
                <p>
                    Nom :
                    <input type="text" class="form-control" name="Nom" placeholder="Nom" value="<?= $Etudient['Nom'] ?>">
                </p>
                <p>
                    Prenom :
                    <input type="text" class="form-control" name="Prenom" placeholder="Prenom" value="<?php echo($Etudient['Prenom']) ?>">
                </p>
                <p>
                    Login :
                    <input type="text" class="form-control" name="Login" placeholder="Login" value="<?= $Etudient['Login'] ?>">
                </p>
                <p>
                    Mot DE Pass :
                    <input type="text" class="form-control" name="Pass" placeholder="MDP" value="<?= $Etudient['Pass'] ?>">
                </p>
                <p>
                    Groupe:
                    <select name="Groupe" id="" class="form-select">
                    <option value="<?= $Etudient['IdGroup'] ?>" class="text-primary "><?= $Etudient['NomGroup'] ?>(current groupe)</option>

                        <?php foreach($Groupes as $groupe) { 
                            if($Etudient['IdGroup']==$groupe['IdGroup']){
                            ?>
                              
                            <?php }else{ ?>
                                <option value="<?= $groupe['IdGroup'] ?>"><?= $groupe['NomGroup'] ?></option>
                        <?php }}?>
                    </select>
                </p>
                <p>
                    <button class="btn btn-primary" name="done">Modifier</button>
                </p>
            </form>
        </div>
    </div>

</body>

</html>