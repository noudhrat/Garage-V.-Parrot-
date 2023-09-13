<?php 
    session_start();
    require_once('templates/header.php');
    // require_once('lib/users/securityAction.php');
    require_once('lib/horaire/infosedithoraire.php');
    require_once('lib/horaire/edithoraireaction.php'); 
?>




<section class="edit-horaire">
    <?php if (isset($errorMsg)) { echo '<p>' . $errorMsg . '</p>'; } ?>
    <form class="container" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Horaire</label>
            <textarea class="form-control" name="horaire"><?= $horaire_horaire; ?></textarea>
        </div>
    <button type="submit" class="btn btn-primary" name="validate">Modifier l'horaire</button>
    </form>
</section>


