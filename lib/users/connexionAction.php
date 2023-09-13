<?php 
session_start();
require_once('lib/pdo.php');

// validation du form
if(isset($_POST['validate'])){
    // vérifié si le user a bien complété les champs
    if(!empty($_POST['email']) AND !empty($_POST['password'])){

        // les données de l'user
        $user_email = htmlspecialchars($_POST['email']);
        $user_password = htmlspecialchars($_POST['password']);

        //Vérifier si l'user existe(si le pseudo est correct)
        $checkIfUserExists = $bdd->prepare('SELECT * FROM users WHERE email = ?');
        $checkIfUserExists->execute(array($user_email));

        // recup de donnée sup à 1 (c'est bon)
        if($checkIfUserExists->rowCount() > 0){
            // recup les données de l'utilisateur
            $usersInfos =   $checkIfUserExists->fetch();

            // Vérifier si le mdp est correct
            if(password_verify($user_password, $usersInfos['mdp'])){

                // authentifier l'utilisateur sur le site et récup les donné dans des variable globale de session
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $usersInfos['id'];
            $_SESSION['lastname'] = $usersInfos['nom'];
            $_SESSION['firstname'] = $usersInfos['prenom'];
            $_SESSION['email'] = $usersInfos['email']; 
            $_SESSION['role'] = $usersInfos['role'];
            

            header('Location: index.php');

            }else{
                $errorMsg = "Votre mot de passe est incorrect...";
            }

        }else{
            $errorMsg = "Votre pseudo est incorrect...";
        }

    }else{
    $errorMsg = "Veuillez compléter tous les champs...";
    } //pour voir si une variable existe
}