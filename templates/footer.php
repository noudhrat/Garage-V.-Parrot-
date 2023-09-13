<footer class=" d-flex align-items-center border-top">

  <div class="logo col-sm-4">
    <a class="text-dark fs-4 px-4" href="#">Garage V. Parrot</a>
    <?php
        require_once('lib/pdo.php'); // Include the database connection file

        $getHoraires = $bdd->prepare('SELECT * FROM horaires LIMIT 1'); // Fetch only the first entry
        $getHoraires->execute();
        $horaire = $getHoraires->fetch(PDO::FETCH_ASSOC);

        if ($horaire && isset($horaire['horaire'])) {
          echo '<p class="text-muted px-4"> garage : ' . $horaire['horaire'] . '</p>';
        }
      ?>
  </div>
  <!-- fin logo -->


  <div class="contact col-sm-4">
    <h4 class="text-dark  pt-5 pb-3">Contact</h4>

    <div class="adresse text-muted">
      <p>29 Rue de Bièvre, 75005 Paris</p>
    </div>

    <div class="numero text-muted">
      <p>Tél +216 12 123 123</p>
    </div>

    <div class="adresse-mail text-muted">
      <p>v.parrot@gmail.com</p>
    </div>
    
  </div>
  <!-- fin contact -->

  <div class="horaire col-sm-4">
    <h4 class="text-dark  pb-3 pt-5">Nos horaires d'ouverture</h4>
    <p class="text-muted">lun : 08h45-12h00 - 14h00-18h00</p>
    <p class="text-muted">mar : 08h45-12h00 - 14h00-18h00</p>
    <p class="text-muted">sam : 08h45-12h00</p>
    <p class="text-muted">dim : Fermé</p> 
  </div>
  <!-- fin horaire -->

</footer>
<!-- fin footer -->
</main>
<!-- fin main -->

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
<script src="../js/script.js"></script>

 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

</body>
</html>


