<?php
require_once('lib/pdo.php');

if(isset($_POST['validate'])){
    if(!empty($_POST['horaire'])){
        $new_horaire_horaire = htmlspecialchars($_POST['horaire']);


        $editHoraireOnWebsite = $bdd->prepare('UPDATE horaires SET horaire = ? WHERE id = ?');
        $editHoraireOnWebsite->execute(array($new_horaire_horaire, $idOfHoraire));

        // header('Location: index.php');
        // exit();
    } else {
        $errorMsg = "Veuillez compléter tous les champs...";
    }
}
?>




