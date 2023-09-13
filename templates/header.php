
<?php
  require_once('lib/config.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fontawesome icon-->
    <script src="https://kit.fontawesome.com/c1a49731ed.js" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- fichier css-->
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Garage V. Parrot</title>
</head>
<body>


    <nav class=" navbar navbar-expand-lg bg-body-tertiary mb-3 sticky-top">
      <div class="container-fluid">
        <a href="index.php" class=" px-4 navbar-brand  mb-2 mb-md-0 text-dark text-decoration-none fw-bold">Garage V. Parrot</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse " id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item active mx-2">
                <a class="nav-link active text-light-emphasis" aria-current="page" href="index.php">Accueil</a>
            </li>
            <li class="nav-item  mx-3">
                <a class="nav-link text-light-emphasis" href="#services">Nos services</a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link text-light-emphasis" href="#véhicules">Véhicules</a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link text-light-emphasis" href="#apropos">A propos</a>
            </li>
            <li class="nav-item mx-3">
                <a id="contactButton" class="nav-link text-light-emphasis" href="#">Contact</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link text-light-emphasis" href="rendezvous.php">Rendez-vous</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <?php
                if(isset($_SESSION['auth'])){  
                  ?>
                <li class="nav-item">
                  <a class="btn btn-outline-primary me-4" href="profile.php?id=<?= $_SESSION['id']; ?>">Mon profil</a>
                </li>
        
                <li class="nav-item">
                  <a class="btn btn-outline-primary " href="lib/users/logoutAction.php">Se déconnecter</a>
                </li>
        
                <?php
        
                } else {
              ?>
                <div class="d-flex mx-5">
                  <li class="nav-item">
                    <a href="connexion.php" class="btn btn-outline-primary me-4">Se connecter</a>
                  </li>
                </div>
                <?php
                }
                ?>
          </ul>
        </div>
      </div>
    </nav>
    
  




