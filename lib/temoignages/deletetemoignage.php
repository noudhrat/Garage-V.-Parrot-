<?php
session_start();
require_once('../pdo.php'); 

if (!isset($_SESSION['auth'])) {
    header('Location: ../../login.php');
    exit();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idOfTheTemoignage = $_GET['id'];

    
    $checkIfTemoignageExists = $bdd->prepare('SELECT id FROM temoignage WHERE id = ?');
    $checkIfTemoignageExists->execute([$idOfTheTemoignage]);

    if ($checkIfTemoignageExists->rowCount() > 0) {
   
        $deleteThisTemoignage = $bdd->prepare('DELETE FROM temoignage WHERE id = ?');
        $deleteThisTemoignage->execute([$idOfTheTemoignage]);

      
        header('Location: ../../profile.php');
        exit();
    } else {
        echo "Aucun temoignage n'a été trouvé";
    }
} else {
    echo "Aucun temoignage n'a été trouvé";
}
?>










