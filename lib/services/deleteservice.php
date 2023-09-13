<?php
session_start();
require_once('../pdo.php'); 

if (!isset($_SESSION['auth'])) {
    header('Location: ../../login.php');
    exit();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idOfTheService = $_GET['id'];

    
    $checkIfServiceExists = $bdd->prepare('SELECT id FROM services WHERE id = ?');
    $checkIfServiceExists->execute([$idOfTheService]);

    if ($checkIfServiceExists->rowCount() > 0) {
       
        $deleteThisService = $bdd->prepare('DELETE FROM services WHERE id = ?');
        $deleteThisService->execute([$idOfTheService]);

   
        header('Location: ../../profile.php');
        exit();
    } else {
        echo "Aucun service n'a été trouvé";
    }
} else {
    echo "Aucun service n'a été trouvé";
}
?>










