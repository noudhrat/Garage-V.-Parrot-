<?php
session_start();
require_once('../config.php');
require_once('../pdo.php'); 

if (isset($_GET['id'])) {
    $temoignageId = $_GET['id'];

    // Récupérez le témoignage existant à partir de l'ID
    $getExistingTemoignage = $bdd->prepare('SELECT * FROM temoignage WHERE id = :id');
    $getExistingTemoignage->bindParam(':id', $temoignageId);
    $getExistingTemoignage->execute();
    $existingTemoignage = $getExistingTemoignage->fetch(PDO::FETCH_ASSOC);

    // Insérez le témoignage basé sur le témoignage existant dans la base de données
    $insertTemoignage = $bdd->prepare('INSERT INTO temoignage (nom, message, note) VALUES (:nom, :message, :note)');
    $insertTemoignage->bindParam(':nom', $existingTemoignage['nom']);
    $insertTemoignage->bindParam(':message', $existingTemoignage['message']);
    $insertTemoignage->bindParam(':note', $existingTemoignage['note']);
    if ($insertTemoignage->execute()) {
        $_SESSION['successMsg'] = "Le témoignage a été ajouté avec succès.";
    } else {
        $_SESSION['errorMsg'] = "Une erreur s'est produite lors de l'ajout du témoignage.";
    }
}

header('Location: ../../profile.php'); // Redirigez l'utilisateur vers profile.php après l'ajout
exit();
?>
