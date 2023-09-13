<?php 
    session_start();
    require_once('lib/config.php');
    require_once('lib/pdo.php');
    require_once('templates/header.php');


    if(isset($_POST['validate'])) {
    $nom = $_POST['nom'];
    $message = $_POST['message'];
    $note = $_POST['note'];

    if (!empty($nom) && !empty($message) && !empty($note)) {
        try {
            $insertTemoignageQuery = $bdd->prepare('INSERT INTO temoignage(nom, message, note) VALUES (?, ?, ?)');
            $insertTemoignageQuery->execute(array($nom, $message, $note));

            $successMsg = "Votre témoignage a bien été publié sur le site";
        } catch (Exception $e) {
            $errorMsg = "Une erreur s'est produite lors de la publication de votre témoignage.";
        }
    } else {
        $errorMsg = "Veuillez compléter tous les champs du formulaire.";
    }
    }
    ?>

    <section class="temoignage-form">
        <h2 class="pt-5 pb-5 mx-5">Publier un Témoignage</h2>
        <?php
        if(isset($errorMsg)) {
            echo '<p class="error-message">' . $errorMsg . '</p>';
        } elseif(isset($successMsg)) {
            echo '<p class="success-message">' . $successMsg . '</p>';
        }
        ?>
        <form class="container" method="POST">

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nom :</label>
                <input type="text" class="form-control" name="nom" id="nom" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" >Message :</label>
                <textarea class="form-control"  name="message" id="message" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Note :</label>
                <input type="text" class="form-control"  name="note" id="note" required>
            </div>

            <div class="col-12 mb-5">
                <button class="btn btn-primary" type="submit" name="validate">Publier</button>
            </div>

        </form>
    </section>


    <?php
    require_once('templates/footer.php');
    ?>


