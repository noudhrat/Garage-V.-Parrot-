
<?php
require_once('lib/config.php');
require_once('lib/pdo.php');

// Valider le formulaire
if(isset($_POST['validate'])){
    // Vérifier si les champs ne sont pas vides
    if(
        !empty($_POST['voiture_id']) && 
        !empty($_POST['nom']) &&
        !empty($_POST['description']) // Supprimez la virgule en trop ici
    ){
        // Données des voitures
        $voiture_id = intval($_POST['voiture_id']);
        $nom = nl2br(htmlspecialchars($_POST['nom']));
        $description = nl2br(htmlspecialchars($_POST['description']));

        $insertCarQuery = $bdd->prepare('INSERT INTO caracteristique(voiture_id, nom, description) VALUES (?, ?, ?)');
        $insertCarQuery->execute(
            array(
                $voiture_id,
                $nom,
                $description
            )
        );

        $successMsg = "La description a été ajoutée avec succès.";
    } else {
        $errorMsg = "Veuillez compléter tous les champs, y compris la description...";
    }
}
?>
