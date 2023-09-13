document.getElementById("contactButton").addEventListener("click", function() {
  var emailAddress = "victorparrot25@gmail.com"; // Remplacez par votre adresse Gmail
  
  // Crée un lien mailto avec l'adresse pré-remplie
  var mailtoLink = "mailto:" + emailAddress;

  // Ouvre l'application de messagerie par défaut avec le lien mailto
  window.location.href = mailtoLink;
});



var priceRange = document.getElementById('priceRange');
var priceLabel = document.getElementById('priceLabel');

priceRange.addEventListener('input', function() {
var price = priceRange.value;
priceLabel.textContent = '4790€ - ' + price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + '€';
});







var mileageRange = document.getElementById('mileageRange');
var mileageLabel = document.getElementById('mileageLabel');

mileageRange.addEventListener('input', function() {
var mileage = mileageRange.value;
mileageLabel.textContent = '177220 km - ' + mileage.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") ;
});



var yearRange = document.getElementById('yearRange');
  var yearLabel = document.getElementById('yearLabel');

  yearRange.addEventListener('input', function() {
    var year = yearRange.value;
    yearLabel.textContent = year + ' - 2010';
  });



  document.getElementById("searchButton").addEventListener("click", function() {
      var minPrice = document.getElementById('priceRange').value;
      var maxMileage = document.getElementById('mileageRange').value;
      var maxYear = document.getElementById('yearRange').value;

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
              if (xhr.status === 200) {
                  var resultsContainer = document.getElementById('resultats');
                  resultsContainer.innerHTML = xhr.responseText;
              } else {
                  console.error('Une erreur s\'est produite lors de la requête AJAX.');
              }
          }
      };

      xhr.open('GET', 'rechercher.php?minPrice=' + minPrice + '&maxMileage=' + maxMileage + '&maxYear=' + maxYear, true);
      xhr.send();
  });