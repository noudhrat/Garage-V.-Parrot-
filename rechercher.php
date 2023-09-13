<?php
require_once('lib/pdo.php'); 

$minPrice = $_GET['minPrice'];
$maxMileage = $_GET['maxMileage'];
$maxYear = $_GET['maxYear'];

$getVoitures = $bdd->prepare('SELECT * FROM voitures WHERE prix >= :minPrice AND kilometrage <= :maxMileage AND annee <= :maxYear');
$getVoitures->bindParam(':minPrice', $minPrice, PDO::PARAM_INT);
$getVoitures->bindParam(':maxMileage', $maxMileage, PDO::PARAM_INT);
$getVoitures->bindParam(':maxYear', $maxYear, PDO::PARAM_INT);
$getVoitures->execute();
$voitures = $getVoitures->fetchAll(PDO::FETCH_ASSOC);

if (empty($voitures)) {
    echo '<p class="text-center">Aucun véhicule trouvé</p>';
} else {
foreach ($voitures as $voiture) {
    ?>
    <div class="col-md-3 mb-4 mx-5">
        <div class="card">
            <a href="description_voiture.php?id=<?= $voiture['id']; ?>">
                <img src="<?= $voiture['image']; ?>" class="card-img-top" alt="Image de la voiture">
            </a>
            <div class="card-body">
                <h5 class="card-title fw-bold"><?= $voiture['marque']; ?></h5>
                <p class="card-text">Année: <?= $voiture['annee']; ?></p>
                <p class="card-text">Kilométrage: <?= $voiture['kilometrage']; ?> km</p>
                <p class="card-text">Prix: <?= $voiture['prix']; ?> €</p>
            </div>
        </div>
    </div>
    <?php
}

}
?>



