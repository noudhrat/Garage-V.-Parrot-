<?php

require_once('lib/pdo.php');


$horaire_horaire = "";
// vérifier si l'id de laqt est passé en paramètre dans l'url
if(isset($_GET['id']) AND !empty($_GET['id'])){
    $idOfHoraire = $_GET['id'];
    // vérifier si l'horaire existe
    $checkIfHoraireExists = $bdd->prepare('SELECT * FROM horaires WHERE id = ?');
    $checkIfHoraireExists->execute(array($idOfHoraire));

    // pour compter les données
    if($checkIfHoraireExists->rowCount() > 0){
        // récup les données du service
        $horaireInfos = $checkIfHoraireExists->fetch();
        

            $horaire_horaire = $horaireInfos['horaire'];

    }else{
        $errorMsg ="Aucune horaire n'a été trouvée";
    }

}else{
    $errorMsg ="Aucune horaire n'a été trouvée";
}
   


