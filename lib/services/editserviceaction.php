<?php
require_once('lib/pdo.php');

if(isset($_POST['validate'])){
    if(!empty($_POST['title']) && !empty($_POST['description'])){
        $new_service_title = htmlspecialchars($_POST['title']);
        $new_service_description = nl2br(htmlspecialchars($_POST['description']));

       
        $new_service_image = $service_image;

        if(isset($_FILES['file']) && $_FILES['file']['error'] === 0){
            $uploadDir = _SERVICES_IMG_PATH_; 
            $newFilename = uniqid() . '_' . basename($_FILES['file']['name']);
            $newPath = $uploadDir . $newFilename;

            if(move_uploaded_file($_FILES['file']['tmp_name'], $newPath)){
                $new_service_image = $newPath;
            }
        }

      
        $editServiceOnWebsite = $bdd->prepare('UPDATE services SET title = ?, description = ?, image = ? WHERE id = ?');
        $editServiceOnWebsite->execute(array($new_service_title, $new_service_description, $new_service_image, $idOfService));

        // header('Location: index.php');
        // exit();
    } else {
        $errorMsg = "Veuillez compléter tous les champs...";
    }
}
?>


