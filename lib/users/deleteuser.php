<?php
session_start();
require_once('../pdo.php'); 

if (!isset($_SESSION['auth'])) {
    header('Location: ../../login.php');
    exit();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idOfTheUtilisateur = $_GET['id'];

  
    $checkIfUtilisateurExists = $bdd->prepare('SELECT id FROM users WHERE id = ?');
    $checkIfUtilisateurExists->execute([$idOfTheUtilisateur]);

    if ($checkIfUtilisateurExists->rowCount() > 0) {
      
        $deleteThisUtilisateur = $bdd->prepare('DELETE FROM users WHERE id = ?');
        $deleteThisUtilisateur->execute([$idOfTheUtilisateur]);

    
        header('Location: ../../profile.php');
        exit();
    } else {
        echo "Aucun utilisateur n'a été trouvé";
    }
} else {
    echo "Aucun utilisateur n'a été trouvé";
}
?>










