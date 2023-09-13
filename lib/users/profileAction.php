<?php 
// session_start();
require_once('lib/pdo.php');

// Récup l'id de l'user
if(isset($_GET['id']) AND !empty($_GET['id'])){

    //l'id de l'user
    $idOfUser = $_GET['id'];

    // vérifier si l'user existe
    $checkIfUserExists = $bdd->prepare('SELECT email, nom, prenom FROM users WHERE id = ?');
    $checkIfUserExists->execute(array( $idOfUser));

    if($checkIfUserExists->rowCount() > 0){

        // récup toutes les donneés de l'user
        $usersInfos =  $checkIfUserExists->fetch();

        $user_email = $usersInfos['email'];
        $user_lastname = $usersInfos['nom'];
        $user_firstname = $usersInfos['prenom'];

        // récup toutes les question publiées par l'user
        // $getHisQuestions = $bdd->prepare('SELECT * FROM questions WHERE id_auteur = ? ORDER BY id DESC');
        // $getHisQuestions->execute(array( $idOfUser));

    }else{
        $errorMsg = "Aucun utilisateur trouvé";
    }

}else{
    $errorMsg = "";
}




