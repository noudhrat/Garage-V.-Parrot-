<?php
  require_once('lib/config.php');
  require_once('lib/pdo.php');

//valider le form
if(isset($_POST['validate'])){
    //vérifier si les champs ne sont pas vide
    // if(!empty($_POST['title']) AND !empty($_POST['description']) AND !empty($_FILES['file']['name'])){
       if(!empty($_POST['title']) AND !empty($_POST['description']) AND isset($_FILES['file']) && $_FILES['file']['error'] === 0){

        //les données des services
        $service_title = htmlspecialchars($_POST['title']);
        $service_description = nl2br(htmlspecialchars($_POST['description']));
        
       // Vérifier le type de fichier (image)
       $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
       $fileExtension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
       if (in_array($fileExtension, $allowedExtensions)) {
           // Gérer l'upload de l'image
        //    $uploadDirectory = 'upload/';
           $uploadDirectory = _SERVICES_IMG_PATH_;
           $uploadedFilePath = $uploadDirectory . basename($_FILES['file']['name']);
           if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFilePath)) {
               // Insérer le service dans la base de données avec le chemin de l'image

               $insertserviceOnWebsite = $bdd->prepare('INSERT INTO services(title, description, image) VALUES (?, ?, ?)');
               $insertserviceOnWebsite->execute(
                   array(
                       $service_title, 
                       $service_description, 
                       $uploadedFilePath // Chemin de l'image dans le serveur
                   )
               );

               $successMsg = "Votre question avec image a bien été publiée sur le site";
           } else {
               $errorMsg = "Une erreur s'est produite lors du téléchargement de l'image";
           }
       } else {
           $errorMsg = "Le type de fichier n'est pas autorisé. Veuillez choisir une image (JPG, JPEG, PNG, GIF)";
       }
   } else {
       $errorMsg ="Veuillez compléter tous les champs, y compris l'image...";
   }
}



