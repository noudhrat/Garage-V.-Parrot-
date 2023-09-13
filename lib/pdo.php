
<?php
try{
    // session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=garage_v_parrot;charset=utf8; ', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Mettre à jour le rôle de l'utilisateur ayant l'ID 1 en "admin"
        $user_id_admin = 1;
        $sql_admin = "UPDATE users SET role = 'admin' WHERE id = :user_id";
        $stmt_admin = $bdd->prepare($sql_admin);
        $stmt_admin->bindParam(':user_id', $user_id_admin);
        $stmt_admin->execute();
    
        // echo "L'utilisateur avec l'ID $user_id_admin a été promu en administrateur avec succès.<br>";
    
        // Mettre à jour le rôle de tous les autres utilisateurs en "employee"
        $sql_employee = "UPDATE users SET role = 'employee' WHERE id <> :user_id";
        $stmt_employee = $bdd->prepare($sql_employee);
        $stmt_employee->bindParam(':user_id', $user_id_admin);
        $stmt_employee->execute();
    
        // echo "Les autres utilisateurs ont été définis comme employés avec succès.";
}catch(Exception $e){
    die('Une erreur a été trouvée : ' .$e->getMessage());
}












