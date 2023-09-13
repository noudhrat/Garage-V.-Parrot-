<?php
session_start();
require_once('templates/header.php');
?>
    
  <main class="container-fluid">

    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis header">
      <div class="col-lg-12">
        <h1 class=" font-weight-bold text-white ">Bienvenue chez V. PARROT</h1>
        <p class=" text-white my-3">Votre Escale pour des voitures bien entretenues</p>
      </div>
    </div>

    <!-- service -->
    <section id="services" class="services pb-5">
      <h2 class="pt-5 pb-5 col-6 px-5 fw-bold">Services</h2>
  
      <div class="les-services row">

      <?php
          require_once('lib/pdo.php'); // Include the database connection file

          $getServices = $bdd->prepare('SELECT * FROM services');
          $getServices->execute();
          $services = $getServices->fetchAll(PDO::FETCH_ASSOC);

          foreach ($services as $service) {
          ?>

      <!-- 1er service -->
      <div class="card mb-3 bg-body-tertiary me-5 d-flex mx-5">
        <div class="row g-0">
          <div class="col-lg-3">
            <img src="<?= $service['image']; ?>" class="img-fluid" alt="...">
          </div>

          <div class="col-lg-9">
            <div class="card-body">
              <h5 class="card-title"><?= $service['title']; ?></h5>
              <p class="card-text"><?= $service['description']; ?></p>
            </div>
          </div>

        </div>
      </div>
      <!-- fin service -->
      <?php
        }
      ?>
        
      </div>
    </section>
    <!-- fin section services -->



    <!-- Filtre véhicule -->
    <section id="véhicules" class="filtre-voiture bg-light">

      <h2 class="text-center text-dark pt-5 pb-5 mt-5">Rechercher un véhicule d'occasion</h2>

      <div class=" filtre d-flex justify-content-center align-items-center text-center row">
        <div class="filtre col-sm-4">
          <input type="range" min="4790" max="9190" value="0" step="100" id="priceRange">
          <span class="text-dark" id="priceLabel">4790€ - 9190€</span>
        </div>
        
        <div class="filtre col-sm-4">
          <input type="range" min="177220" max="267220" value="1000" step="100" id="mileageRange">
          <span class="text-dark" id="mileageLabel">177220 km - 267220</span>
        </div>
        
        <div class="filtre col-sm-4">
          <input type="range" min="2001" max="2010" value="2001" step="1" id="yearRange">
          <span class="text-dark" id="yearLabel">2001 - 2010</span>
        </div>

      </div>
      <!-- fin les filtres -->

      <div class="d-grid gap-2 col-6 mx-auto pb-5 row">
        <button class="btn btn-primary text-light p-3 col-sm-12 mt-3" type="button" id="searchButton" >Rechercher</button>
      </div>
      <!-- fin bouton -->

      <div class="row" id="resultats">
            <!-- Les résultats seront affichés ici -->
      </div>
    </section>
    <!-- fin section filtre voiture -->

     <!-- A propos -->
    <section id="apropos" class="apropos row mt-5 mb-5">
      <div class="image text-center mt-5 mb-5 col-md-6">
        <img class="img-fluid" src="assets/img/apropos.jpg" alt="image apropos" width="455" height="600">
      </div>

      <div class="col-md-6  d-flex justify-content-center align-items-center">
        <div class="pt-4 contenu pb-5">
          <h2 class="text-center">A propos</h2>
          <p>Vincent Parrot, fort de ses 15 années d'expérience dans la réparation automobile, a ouvert 
            son propre garage à Toulouse en 2021.
            
            Depuis 2 ans, il propose une large gamme de services: <br><br>réparation de la carrosserie et de la 
            mécanique des voitures ainsi que leur entretien régulier pour garantir leur performance et 
            leur sécurité. De plus, le Garage V. Parrot met en vente des véhicules d'occasion afin 
            d'accroître son chiffre d'affaires.<br><br>
            
            Vincent Parrot considère son atelier comme un véritable lieu de confiance pour ses clients et 
            leurs voitures doivent, selon lui, à tout prix être entre de bonnes mains.</p>
        </div>
      </div>
    </section>
    <!-- fin a propos -->


    <!-- temoignage -->
    <section class="temoignage bg-body-tertiary row mb-5">
      <h2 class=" col-sm-6 d-flex justify-content-center align-items-center pb-5 text-dark">Il nous font confiance</h2>

      <swiper-container class="mySwiper col-sm-6 pt-5" rewind="true" navigation="true">

        <?php
        require_once('lib/pdo.php'); // Include the database connection file

        $getTemoignages = $bdd->prepare('SELECT * FROM temoignage');
        $getTemoignages->execute();
        $temoignages = $getTemoignages->fetchAll(PDO::FETCH_ASSOC);

        foreach ($temoignages as $temoignage) {
        ?>

        <!-- card -->
        <swiper-slide class="card">
          <div class="profil">
            <div class="profile-details">
              <p class="name px-3"><?= $temoignage['nom']; ?></p>
            </div>
          </div>
          <!-- fin profil -->

          <div class="profile-text">
            <p><?= $temoignage['message']; ?></p>
            <p class="note"><?= $temoignage['note']; ?></p>
          </div>
          <!-- fin profil-text -->

        </swiper-slide>
        <!-- fin card -->
        <?php
        }
        ?>
      </swiper-container>

      <a href="temoignage.php"> <button type="button" class="btn btn-outline-primary mb-5 mt-5">Laisser un témoignage</button></a>
    </section>
    <!-- fin temoignage -->


<script src="js/script.js"></script>
<?php

require_once('templates/footer.php');

?>




