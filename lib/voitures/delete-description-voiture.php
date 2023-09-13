<?php
session_start();
require_once('../pdo.php'); 

if (!isset($_SESSION['auth'])) {
    header('Location: ../../login.php');
    exit();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idOfTheVoiture = $_GET['id'];

   
    $checkIfVoitureExists = $bdd->prepare('SELECT id FROM description_voiture WHERE id = ?');
    $checkIfVoitureExists->execute([$idOfTheVoiture]);

    if ($checkIfVoitureExists->rowCount() > 0) {
        
        $deleteThisVoiture = $bdd->prepare('DELETE FROM description_voiture WHERE id = ?');
        $deleteThisVoiture->execute([$idOfTheVoiture]);

      
        header('Location: ../../profile.php');
        exit();
    } else {
        echo "Aucune description n'a été trouvé";
    }
} else {
    echo "Aucune description n'a été trouvé";
}
?>










