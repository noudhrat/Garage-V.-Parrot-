<?php
require_once('lib/config.php');
require_once('lib/pdo.php');

// Valider le formulaire
if(isset($_POST['validate'])){
    // Vérifier si les champs ne sont pas vides
    if(
        !empty($_POST['voiture_id']) && 
        !empty($_POST['annee']) &&
        !empty($_POST['kilometrage']) &&
        !empty($_POST['prix']) &&
        isset($_FILES['image']) && $_FILES['image']['error'] === 0
    ){
        // Données des voitures
        $voiture_id = intval($_POST['voiture_id']);
        $annee = intval($_POST['annee']);
        $kilometrage = intval($_POST['kilometrage']);
        $prix = intval($_POST['prix']);

        // Vérifier le type de fichier (image)
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions)) {
            // Gérer l'upload de l'image
            $uploadDirectory = _VOITURES_IMG_PATH_;
            $uploadedFilePath = $uploadDirectory . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFilePath)) {
                // Insérer la voiture dans la base de données avec le chemin de l'image

                $insertCarQuery = $bdd->prepare('INSERT INTO description_voiture(image, annee, voiture_id, kilometrage, prix) VALUES (?, ?, ?, ?, ?)');
                $insertCarQuery->execute(
                    array(
                        $uploadedFilePath, // Chemin de l'image dans le serveur
                        $annee,
                        $voiture_id,
                        $kilometrage,
                        $prix
                    )
                );

                $successMsg = "La description a été ajoutée avec succès.";
            } else {
                $errorMsg = "Une erreur s'est produite lors du téléchargement de l'image.";
            }
        } else {
            $errorMsg = "Le type de fichier n'est pas autorisé. Veuillez choisir une image (JPG, JPEG, PNG, GIF)";
        }
    } else {
        $errorMsg ="Veuillez compléter tous les champs, y compris l'image...";
    }
}


?>



