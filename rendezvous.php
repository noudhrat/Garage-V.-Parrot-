<?php 
    session_start();
    require_once('templates/header.php');
    // require_once('lib/users/rendezvousAction.php');
?>


<form class="row g-3 mx-5" action="rendezvousAction.php" method="post">

  <div class="col-md-4">
    <label for="name" class="form-label"> Nom</label>
    <input type="text" class="form-control" name='name' id="name" required>
  </div>

  <div class="col-md-4">
    <label for="email" class="form-label">Email</label>
    <div class="input-group has-validation">
      <span class="input-group-text" id="inputGroupPrepend">@</span>
      <input type="email" class="form-control" name="email" id="email" aria-describedby="inputGroupPrepend" required>
    </div>
  </div>

  <div class="col-md-4">
    <label for="tel" class="form-label"> Tel</label>
    <input type="text" class="form-control" name='phone' id="phone" required>
  </div>


  <div class="col-md-3">
    <label for="schedule" class="form-label">Objet</label>
    <select class="form-select" name="object" id="object" required>
      <option selected disabled value="">Choose...</option>
      <option>Achat de voiture d'occasion</option>
      <option>Réparation</option>
      <option>Entretien</option>
      <option>Autres</option>
    </select>
  </div>

  <div class="col-md-3">
    <label for="schedule" class="form-label">Horaire</label>
    <select class="form-select" name="schedule" id="schedule" required>
      <option selected disabled value="">Choose...</option>
      <option>lun : 10h45</option>
      <option>lun : 9h45</option>
      <option>lun : 16h00</option>
      <option>lun : 14h00</option>
      <option>lun : 15h30</option>
      <option>mar : 10h45</option>
      <option>mar : 16h00</option>
      <option>mar : 14h00</option>
      <option>sam : 8h30</option>
      <option>sam : 9h45</option>
      <option>sam : 10h30</option>
      <option>sam : 11h00</option>
    </select>
  </div>



  <div class="mb-3">
    <label for="message" class="form-label">Message</label>
    <textarea class="form-control" name="message" id="message" rows="3"></textarea>
  </div>
  
  <div class="col-12 mb-5">
    <button class="btn btn-primary" type="submit">Submit form</button>
  </div>

</form>

<?php
require_once('templates/footer.php');
?>