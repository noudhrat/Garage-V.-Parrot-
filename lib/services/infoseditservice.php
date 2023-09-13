<?php

require_once('lib/pdo.php');

// vérifier si l'id de laqt est passé en paramètre dans l'url
if(isset($_GET['id']) AND !empty($_GET['id'])){

    $idOfService = $_GET['id'];
    // vérifier si le service existe
    $checkIfServiceExists = $bdd->prepare('SELECT * FROM services WHERE id = ?');
    $checkIfServiceExists->execute(array($idOfService));

    // pour compter les données
    if($checkIfServiceExists->rowCount() > 0){
        // récup les données du service
        $serviceInfos = $checkIfServiceExists->fetch();
        

            $service_title = $serviceInfos['title'];
            $service_description = $serviceInfos['description'];
            $service_image = $serviceInfos['image'];

            $service_description = str_replace('<br />','', $service_description);
            $service_image = str_replace('<br />','', $service_image);

     

    }else{
        $errorMsg ="Aucun service n'a été trouvée";
    }

}else{
    $errorMsg ="Aucun service n'a été trouvée";
}
   
