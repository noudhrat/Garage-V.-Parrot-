<?php
session_start();
require_once('lib/pdo.php');
require_once('templates/header.php');

if (isset($_GET['id'])) {
    $voiture_id = $_GET['id'];

    $getDescription = $bdd->prepare('SELECT * FROM description_voiture WHERE voiture_id = :voiture_id');
    $getDescription->bindParam(':voiture_id', $voiture_id, PDO::PARAM_INT);
    $getDescription->execute();
    $description = $getDescription->fetch(PDO::FETCH_ASSOC);
    
    if ($description) {
        ?>
        <div class="container mb-5 description-voiture">
              <img class="d-block w-100 img-fluid rounded pt-5" src="<?= $description['image']; ?>" alt="Image de la voiture">
              <div class="d-flex justify-content-center align-items-center my-3 d-flex flex-wrap">
                <p class="mx-5"><span class=" mx-5 fw-bold text-primary">Année:</span> <?= $description['annee']; ?></p>
                <p><span class="mx-5 fw-bold text-primary">kilométrage:</span> <?= $description['kilometrage']; ?> km</p>
                <p> <span class="mx-5 fw-bold text-primary">Prix du véhicule</span> <?= $description['prix']; ?> €</p>
              </div>

              <a href="rendezvous.php"> <button type="button" class="btn btn-outline-primary mb-5 mt-5">Rendez-vous pour le véhicule</button></a>
        </div>
        <?php
    } else {
        echo "Aucune description trouvée pour cette voiture.";
    }
} else {
    echo "ID de voiture non spécifié.";
}




if (isset($_GET['id'])) {
    $voiture_id = $_GET['id'];

    $getCaracteristique = $bdd->prepare('SELECT * FROM caracteristique WHERE voiture_id = :voiture_id');
    $getCaracteristique->bindParam(':voiture_id', $voiture_id, PDO::PARAM_INT);
    $getCaracteristique->execute();
    $caracteristique = $getCaracteristique->fetch(PDO::FETCH_ASSOC);
    
    if ($caracteristique) {
        ?>
        <div class="container bg-body-tertiary">
             <h2> Caracteristiques</h2>
             <div class="d-flex my-3">
                 <p class="mx-4"> <?= $caracteristique['nom']; ?></p>
                 <p> <?= $caracteristique['description']; ?></p>
             </div>
            <!-- Autres détails de la description -->
        </div>
        <?php
    } else {
        echo "Aucune caracteristique trouvée pour cette voiture.";
    }
} else {
    echo "ID de voiture non spécifié.";
}


?>






