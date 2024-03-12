<?php
require("../../Connexiondb.php");   
session_start();
if (!isset($_SESSION['data'])) {
    header("location:../../Index.php");
}else{
    if(isset($_GET['idGroup'])){
        $sql = $db->prepare("DELETE FROM groupe where IdGroup=?");
        $sql->execute([$_GET['idGroup']]);
        header("location:Groupes.php");
    }
}
?>