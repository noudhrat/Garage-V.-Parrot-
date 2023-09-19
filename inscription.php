<?php
  session_start();
  require_once('templates/header.php');
  require_once('lib/users/inscriptionAction.php'); ?>

  <section class="contact mx-5 mb-5 mt-5">
    <div class="contact-form-container">
        <form method="POST">
          <?php if(isset($errorMsg)){ echo '<p>' .$errorMsg. '</p>'; } ?>

          <h1 class="underline">Inscrivez-vous !</h1>
          <div class="form-group mt-2">
              <label class="sr-only"></label>
              <input  type="text"  class="form-control" placeholder="votre nom" autofocus name="lastname">
          </div>

          <div class="form-group mt-2">
              <label class="sr-only"></label>
              <input type="text" class="form-control" placeholder="votre prenom" autofocus name="firstname">
          </div>

          <div class="form-group mt-2">
              <label for="exampleInputEmail1" class="sr-only"></label>
              <input type="email" class="form-control" placeholder="votre email" autofocus name="email">
          </div>

          <div class="form-group mt-2">
            <label for="exampleInputPassword1" class="sr-only"></label>
            <input type="password"  class="form-control" placeholder="mot de passe" name="password">
          </div>

          <button class="mt-4 btn btn-primary mb-5" type="submit"  name="validate">S'inscrire</button>
          <br><br>
        </form>
    </div>
  </section>
  
<?php
require_once('templates/footer.php');
?>