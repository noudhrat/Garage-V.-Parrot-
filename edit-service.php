<?php 
    session_start();
    require_once('templates/header.php');
    // require_once('lib/users/securityAction.php');
    require_once('lib/services/infoseditservice.php');
    require_once('lib/services/editserviceaction.php'); 
?>




<section class="contact">
    <?php
            if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; 
            }
      ?>
      <?php
     
        if(isset($service_image)){
        ?>
      <form class="container" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Titre du service</label>
            <input type="text" class="form-control" name="title" value="<?= $service_title; ?>" >
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Description du service</label>
            <textarea class="form-control" name="description"><?= $service_description; ?></textarea>
          </div>

          <div class="mb-3">
            <label for="file" class="form-label">Image</label>
            <input type="file" name="file" id="file">
          </div>

          <button type="submit" class="btn btn-primary" name="validate">Modifier le service</button>
      </form>
      <?php
        }
        
      ?>
    
  </section>




