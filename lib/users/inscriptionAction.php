<?php
// session_start();
require_once('lib/pdo.php');

// validation du form
if(isset($_POST['validate'])){
    // vérifié si le user a bien complété les champs
    if(!empty($_POST['lastname']) AND !empty($_POST['firstname']) AND !empty($_POST['email']) AND !empty($_POST['password'])){

        // les données de l'user
        $user_lastname = htmlspecialchars($_POST['lastname']);
        $user_firstname = htmlspecialchars($_POST['firstname']);
        $user_email = htmlspecialchars($_POST['email']);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // $user_role = htmlspecialchars($_POST['role']);

        // vérifier si l'utilisateur existe déjà sur le site
        $checkIfUserAlreadyExists = $bdd->prepare('SELECT email FROM users WHERE email = ?');
        $checkIfUserAlreadyExists->execute(array($user_email));

       
        if($checkIfUserAlreadyExists->rowCount() == 0){

            // insérer l'utilisateur dans la bdd
            $insertUserOnWebsite = $bdd->prepare('INSERT INTO users(email, nom, prenom, mdp)VALUES(?, ?, ?, ?)');
            $insertUserOnWebsite->execute(array($user_email, $user_lastname, $user_firstname, $user_password));

            //récup les infos de l'utilisateurs
            $getInfosOfThisUserReq = $bdd->prepare('SELECT id, email, nom, prenom FROM users WHERE nom = ? AND prenom = ? AND email = ?');
            $getInfosOfThisUserReq->execute(array($user_lastname, $user_firstname, $user_email));

            $usersInfos =  $getInfosOfThisUserReq->fetch();//tab

            // authentifier l'utilisateur sur le site et récup les donné dans des variable globale de session
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $usersInfos['id'];
            $_SESSION['lastname'] = $usersInfos['nom'];
            $_SESSION['firstname'] = $usersInfos['prenom'];
            $_SESSION['email'] = $usersInfos['email'];
            // $_SESSION['role'] = $usersInfos['role'];
            
            //après l'authen redirigé vers la page d'accueil
            header('location: index.php'); 


        }else{
            $errorMsg ="l'utilisateur existe déjà sur le site";
        }



    }else{
    $errorMsg = "Veuillez compléter tous les champs...";
    } //pour voir si une variable existe
}