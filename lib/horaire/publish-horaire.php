<?php
  require_once('lib/pdo.php');

//valider le form
if(isset($_POST['validate'])){
    //vérifier si les champs ne sont pas vide
    // if(!empty($_POST['title']) AND !empty($_POST['description']) AND !empty($_FILES['file']['name'])){
       if(!empty($_POST['horaire'])){

        //les données des services
        $horaire_horaire = nl2br(htmlspecialchars($_POST['horaire']));
   

               $inserthoraireOnWebsite = $bdd->prepare('INSERT INTO horaires(horaire) VALUES (?)');
               $inserthoraireOnWebsite->execute(
                   array(
                       $horaire_horaire
                   )
               );

               $successMsg = "Votre horaire a bien été publiée sur le site";
         
   } else {
       $errorMsg ="Veuillez compléter tous les champs";
   }
}



