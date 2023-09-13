<?php
  session_start();
  require_once('templates/header.php');
  require_once('lib/config.php');
  require_once('lib/users/profileAction.php');
  require_once('lib/users/securityAction.php');
  require_once('lib/services/publish-service.php');
  require_once('lib/horaire/publish-horaire.php');
  require_once('lib/voitures/publish-voiture.php');
  require_once('lib/voitures/publish-description-voiture.php');
  require_once('lib/voitures/publish-caracteristique-voiture.php');





    try {
        // Récupérer les informations de l'utilisateur depuis la base de données
        $user_id = $_SESSION['id']; 
        $sql = "SELECT * FROM users WHERE id = :user_id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $usersInfos = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usersInfos) {
            die('Utilisateur non trouvé.'); // Gérer le cas où l'utilisateur n'est pas trouvé dans la base de données
        }

        // Vérifier le rôle de l'utilisateur et personnaliser la page 
        if ($usersInfos['role'] === 'admin') {
            // Afficher le contenu personnalisé pour l'admin
            echo "<h3 class= mx-5>Page Administrateur</h3>";
        ?> 

        <?php
        // Affichage des utilisateurs
        try {
            $getUtilisateurs = $bdd->prepare('SELECT * FROM users');
            $getUtilisateurs ->execute();
            $utilisateurs  = $getUtilisateurs ->fetchAll(PDO::FETCH_ASSOC);

            if (count($utilisateurs) === 0) {
                echo "<p>Aucun utilisateur n'a été trouvé dans la base de données.</p>";
            } else {
                ?>
                <section class=" utilisateur pb-5">
                    <h2 class="pt-5 pb-5 mx-5">Utilisateurs</h2>
                    <div class=" ">
                         <div class="button mx-5 mb-5">
                            <a href="inscription.php" class="btn btn-primary ">Créer un compte</a>
                         </div>
                        <?php
                        foreach ($utilisateurs as $utilisateur) {
                            ?>
                            <!-- user Card -->
                            <div class="card mb-3 bg-body-tertiary me-5 mx-5 p-2" style="max-width: 640px;">
                                <div class="row g-0 ">
                                    <div class="col-md-6 d-flex">
                                        <p class="mx-4"><?= $utilisateur['nom']; ?></p>
                                        <p class=""><?= $utilisateur['email']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="button">
                                            <a class="mx-5 btn btn-outline-primary" href="lib/users/deleteuser.php?id=<?= $utilisateur['id']; ?>">Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                            <?php
                        }
                        ?>
                    </div>
                </section>
                <!-- fin users -->
                <?php
            }
        } catch (Exception $e) {
            echo "<p>Une erreur s'est produite lors de la récupération des utilisateurs.</p>";
            echo "<p>Erreur : " . $e->getMessage() . "</p>";
        }
        ?>

            
        <!-- formulaire pour ajouter des services -->
        <section class="service">
            <h2 class="pt-5 pb-5 mx-5">Ajout d'un service</h2>
            <form class="container" method="POST"  enctype="multipart/form-data">
                <?php
                    if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; 
                    }elseif(isset($successMsg)){
                    echo '<p>'.$successMsg.'</p>'; 
                    }
                ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Titre</label>
                    <input type="text" class="form-control" name="title">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Description</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Image</label>
                    <input type="file" name="file" id="file">
                </div>

                <button type="submit" class="btn btn-primary" name="validate">Publier</button>
            </form>
        </section>
        <!-- ajout des services -->     
        <?php

        // Affichage de service
        try {
            $getServices = $bdd->prepare('SELECT * FROM services');
            $getServices->execute();
            $services = $getServices->fetchAll(PDO::FETCH_ASSOC);

            if (count($services) === 0) {
                echo "<p>Aucun service n'a été trouvé dans la base de données.</p>";
            } else {
                ?>
                <section class="services pb-5">
                    <h2 class="pt-5 pb-5 mx-5">Services</h2>
                    <div class="les-services">
                        <?php
                        foreach ($services as $service) {
                            ?>
                            <!-- Service Card -->
                            <div class="card mb-3 bg-body-tertiary me-5 mx-5" style="max-width: 640px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="<?= $service['image']; ?>" class="img-fluid rounded" alt="Service Image">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $service['title']; ?></h5>
                                            <p class="card-text"><?= $service['description']; ?></p>
                                        </div>
                                        <div class="button mx-5 mb-2">
                                            <a class="mx-3 btn btn-outline-primary" href="edit-service.php?id=<?= $service['id']; ?>" >Modifier le service</a>
                                            <a class="btn btn-outline-primary" href="lib/users/deleteservice.php?id=<?= $service['id']; ?>">Supprimer le service</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </section>
                <!-- fin services -->
                <?php
            }
        } catch (Exception $e) {
            echo "<p>Une erreur s'est produite lors de la récupération des services.</p>";
            echo "<p>Erreur : " . $e->getMessage() . "</p>";
        }
        ?>


        <!-- formulaire pour ajouter des horaires -->
        <section class="horaire">
            <h2 class="pt-5 pb-5 mx-5">Ajout d'un horaire</h2>
            <form class="container" method="POST"  enctype="multipart/form-data">
                <?php
                    if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; 
                    }elseif(isset($successMsg)){
                    echo '<p>'.$successMsg.'</p>'; 
                    }
                ?>
                    
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Horaire</label>
                    <textarea class="form-control" name="horaire"></textarea>
                </div>

                <button type="submit" class="btn btn-primary" name="validate">Publier</button>
            </form>
        </section>


         <!-- affichage de l'horaire -->     
        <?php

        try {
            $getHoraires = $bdd->prepare('SELECT * FROM horaires');
            $getHoraires->execute();
            $horaires = $getHoraires->fetchAll(PDO::FETCH_ASSOC);

            if (count($horaires) === 0) {
                echo "<p>Aucune horaire n'a été trouvé dans la base de données.</p>";
            } else {
                ?>
                <section class="horaire pb-5">
                    <h2 class="pt-5 pb-5 mx-5">Horaires</h2>
                    <div class="les-services">
                        
                    <?php
                        $firstHoraire = array_shift($horaires); 
                        ?>
                        <div class="card mb-3 bg-body-tertiary me-5 mx-5" style="max-width: 640px;">
                            <div class="row g-0">
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $firstHoraire['horaire']; ?></h5>
                                    </div>
                                    <div class="button mb-2 mx-3">
                                        <a href="edit-horaire.php?id=<?= $firstHoraire['id']; ?>" >Modifier l'horaire</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            }
        } catch (Exception $e) {
            echo "<p>Une erreur s'est produite lors de la récupération de l'horaire.</p>";
            echo "<p>Erreur : " . $e->getMessage() . "</p>";
        }
        ?>


        <?php
        
            
        } else {
            // Afficher le contenu personnalisé pour les autres utilisateurs (employee)
            echo "<h3 class= mx-5>Page employee</h3>";
            ?>
            
            <!-- affichage des témoignages -->
        <section class="pb-5">
            <h2 class="pt-5 pb-5 mx-5">Témoignages</h2>
            <div class="témoignage">
            <?php
            require_once('lib/pdo.php'); 

            $getTemoignages = $bdd->prepare('SELECT * FROM temoignage');
            $getTemoignages->execute();
            $temoignages = $getTemoignages->fetchAll(PDO::FETCH_ASSOC);

            foreach ($temoignages as $temoignage) {
                ?>
                <!-- Témoignage -->
                <div class="card mb-3 bg-body-tertiary me-5 mx-5" style="max-width: 640px;">
                    <div class=" row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $temoignage['nom']; ?></h5>
                                <p class="card-text"><?= $temoignage['message']; ?></p>
                                <p class="card-text"><?= $temoignage['note']; ?></p>
                            </div>
                            <div class="button px-4 pb-2">
                                <a class="px-2" href="lib/temoignages/deletetemoignage.php?id=<?= $temoignage['id']; ?>">Supprimer le témoignage</a>
                                <!-- <a href="lib/temoignages/ajouttemoignage.php?id=<?= $temoignage['id']; ?>">Ajouter le témoignage</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
        </section>


        <!-- formulaire pour ajouter des voitures -->
        <section class="ajout-voiture mb-2">
            <h2 class="pt-5 pb-5 mx-5">Ajout d'une voiture</h2>
            <form class="container" method="POST"  enctype="multipart/form-data">
            <?php
                if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; 
                }elseif(isset($successMsg)){
                echo '<p>'.$successMsg.'</p>'; 
                }
            ?>
            
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Marque</label>
                    <input type="text" class="form-control" name="marque">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Année</label>
                    <input type="number" class="form-control" name="annee">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Carburant</label>
                    <input type="text" class="form-control" name="carburant">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kilometrage</label>
                    <input type="number" class="form-control" name="kilometrage">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Prix</label>
                    <input type="number" class="form-control" name="prix">
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Image</label>
                    <input type="file" name="image" id="image">
                </div>

                <button type="submit" class="btn btn-primary mb-5" name="validate">Publier</button>
            </form>
        </section>

        <?php

        // Affichage des voitures
        try {
            $getVoitures = $bdd->prepare('SELECT * FROM voitures');
            $getVoitures ->execute();
            $voitures  = $getVoitures ->fetchAll(PDO::FETCH_ASSOC);

            if (count($voitures) === 0) {
                echo "<p>Aucune voiture n'a été trouvé dans la base de données.</p>";
            } else {
                ?>
                <section class=" voiture pb-5 bg-body-tertiary mx-5">
                    <h2 class="pt-5 pb-5 mx-5">Véhicules</h2>
                    <div class="row">
                        <?php
                        foreach ($voitures as $voiture) {
                            ?>
                            <!-- voiture Card -->
                            <div class="col-md-3 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                    <img src="<?= $voiture['image']; ?>" class="card-img-top" alt="Image de la voiture">
                                        <h5 class="card-title fw-bold"><?= $voiture['marque']; ?></h5>
                                            <p class="card-text">Année: <?= $voiture['annee']; ?></p>
                                            <p class="card-text">Kilométrage: <?= $voiture['kilometrage']; ?> km</p>
                                            <p class="card-text">Prix: <?= $voiture['prix']; ?> €</p>
                                        <div class="button">
                                            <a class="mx-5 btn btn-outline-primary" href="lib/voitures/deletevoiture.php?id=<?= $voiture['id']; ?>">Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                            <?php
                        }
                        ?>
                    </div>
                </section>
                <!-- fin voitures -->
                <?php
            }
        } catch (Exception $e) {
            echo "<p>Une erreur s'est produite lors de la récupération des voitures.</p>";
            echo "<p>Erreur : " . $e->getMessage() . "</p>";
        }
        ?>


        <!-- formulaire pour ajouter des description voitures -->
        <section class="ajout-description-voiture mb-2">
            <h2 class="pt-5 pb-5 mx-5">Ajout description de voiture</h2>
            <form class="container" method="POST"  enctype="multipart/form-data">
            <?php
                if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; 
                }elseif(isset($successMsg)){
                echo '<p>'.$successMsg.'</p>'; 
                }
            ?>


                <div class="mb-3">
                    <label for="voiture" class="form-label">Sélectionner une voiture</label>
                    <select class="form-control" name="voiture_id">
                        <?php
                        $getVoitures = $bdd->prepare('SELECT id, marque FROM voitures');
                        $getVoitures->execute();
                        $voitures = $getVoitures->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($voitures as $voiture) {
                            echo '<option value="' . $voiture['id'] . '">' . $voiture['marque'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Année</label>
                    <input type="number" class="form-control" name="annee">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kilometrage</label>
                    <input type="number" class="form-control" name="kilometrage">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Prix</label>
                    <input type="number" class="form-control" name="prix">
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Image</label>
                    <input type="file" name="image" id="image">
                </div>

                <button type="submit" class="btn btn-primary" name="validate">Publier</button>
            </form>
        </section>
        <!-- ajout-description-voiture -->



        <?php
        
        // Affichage de description de voiture
        try {
            $getVoitures = $bdd->prepare('SELECT * FROM description_voiture');
            $getVoitures ->execute();
            $voitures  = $getVoitures ->fetchAll(PDO::FETCH_ASSOC);

            if (count($voitures) === 0) {
                echo "<p> Aucune description n'a été trouvé dans la base de données.</p>";
            } else {
                ?>
                <section class=" voiture pb-5 bg-body-tertiary mx-5">
                    <h2 class="pt-5 pb-5 mx-5">Description de véhicule</h2>
                    <div class=" row">
                        <?php
                        foreach ($voitures as $voiture) {
                            ?>
                            <!-- description voiture Card -->
                            <div class="col-md-3 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="<?= $voiture['image']; ?>" class="card-img-top" alt="Image de la voiture">
                                        <p class="card-text"><?= $voiture['voiture_id']; ?></p>
                                        <p class="card-text">Prix: <?= $voiture['prix']; ?> €</p>
                                        <p class="card-text">Année: <?= $voiture['annee']; ?></p>
                                        <p class="card-text">Kilométrage: <?= $voiture['kilometrage']; ?> km</p>
                                    </div>
                                    <div class="button mb-3">
                                        <a class="mx-5 btn btn-outline-primary" href="lib/voitures/delete-description-voiture.php?id=<?= $voiture['id']; ?>">Supprimer</a>
                                    </div>
                                </div>
                            </div>
                          
                            <?php
                        }
                        ?>
                    </div>
                </section>
                <!-- fin description voitures -->
                <?php
            }
        } catch (Exception $e) {
            echo "<p>Une erreur s'est produite lors de la récupération des descriptions.</p>";
            echo "<p>Erreur : " . $e->getMessage() . "</p>";
        }
        ?>




         <!-- formulaire pour ajouter des caractéristique voitures -->
         <section class="ajout-description-voiture mb-2">
            <h2 class="pt-5 pb-5 mx-5">Ajout caractéristique de voiture</h2>
            <form class="container" method="POST"  enctype="multipart/form-data">
            <?php
                if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; 
                }elseif(isset($successMsg)){
                echo '<p>'.$successMsg.'</p>'; 
                }
            ?>


                <div class="mb-3">
                    <label for="voiture" class="form-label">Sélectionner une voiture</label>
                    <select class="form-control" name="voiture_id">
                        <?php
                        $getVoitures = $bdd->prepare('SELECT id, marque FROM voitures');
                        $getVoitures->execute();
                        $voitures = $getVoitures->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($voitures as $voiture) {
                            echo '<option value="' . $voiture['id'] . '">' . $voiture['marque'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nom</label>
                    <textarea type="text" class="form-control" name="nom" rows="4"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Description</label>
                    <textarea type="text" class="form-control" name="description"rows="4"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary" name="validate">Publier</button>
            </form>
        </section>
        <!-- ajout-caracteristique-voiture -->


        <?php
        // Affichage de caracteristique de voiture
        try {
            $getVoitures = $bdd->prepare('SELECT * FROM caracteristique');
            $getVoitures ->execute();
            $voitures  = $getVoitures ->fetchAll(PDO::FETCH_ASSOC);

            if (count($voitures) === 0) {
                echo "<p> Aucune caracteristique n'a été trouvé dans la base de données.</p>";
            } else {
                ?>
                <section class=" voiture pb-5 bg-body-tertiary mx-5">
                    <h2 class="pt-5 pb-5 mx-5">Caractéristique de véhicule</h2>
                    <div class=" row">
                        <?php
                        foreach ($voitures as $voiture) {
                            ?>
                            <!-- caracteristique voiture Card -->
                            <div class="col-md-3 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-text"><?= $voiture['voiture_id']; ?></p>
                                        <p class="card-text"><?= $voiture['nom']; ?></p>
                                        <p class="card-text"><?= $voiture['description']; ?></p>
                                    </div>
                                    <div class="button mb-3">
                                        <a class="mx-5 btn btn-outline-primary" href="lib/voitures/delete-caracteristique-voiture.php?id=<?= $voiture['id']; ?>">Supprimer</a>
                                    </div>
                                </div>
                            </div>
                          
                            <?php
                        }
                        ?>
                    </div>
                </section>
                <!-- fin caracteristique voitures -->
                <?php
            }
        } catch (Exception $e) {
            echo "<p>Une erreur s'est produite lors de la récupération des caractéristiques.</p>";
            echo "<p>Erreur : " . $e->getMessage() . "</p>";
        }
        ?>


        <?php
        
       
        
        } //else


    } catch (Exception $e) {
        die('Une erreur a été trouvée : ' . $e->getMessage());
    }
    require_once('templates/footer.php');
    ?>


        
  

    

    



   
        
     

       

      
      
      