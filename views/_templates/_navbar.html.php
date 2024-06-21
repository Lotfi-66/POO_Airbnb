<?php

use Core\Session\Session; ?>
<div class="d-flex justify-content-between text-align-center  align-items-center">
  <!-- logo -->
  <div class="nav-logo">
    <a href="/">

      <img src="/assets/img/logo.png" height="100px" alt="logo de l'appli">

    </a>
  </div>

  <!--  barre de navigation -->
  <div class="fav-home">
    <nav>
      <ul class="d-flex justify-content-center">
        <li class="m-1"><a href="/">Accueil</a></li>
        <li class="m-1"><a href="/favoris">Mes favoris</a></li>
      </ul>
    </nav>
  </div>

  <!-- menu du profil -->
  <div class="nav-profil d-flex flex-column flex-w">
    <nav class="custom-nav-profil ">
      <ul class="custom-ul-profil">
        <li class="custom-link">
          <!-- si je suis en session j'affiche mon compte -->
          <?php if ($auth::isAuth()) : ?>




            <div class="d-flex text-align-center align-items-center  nav-responsive space-between">
              <label class="relative ">
                <input id="switchBtn" type="button" />
                <div id="slider" class="slider"></div>
                <span id="choice">Voyageur</span>
              </label>

              <div class="dropdown custom-link p-4" id="nav1">
                <a class="dropdown-toggle button btn-secondary" href="" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  Mon compte
                  <i class="bi bi-person custom-svg"></i>
                </a>
                <ul class="dropdown-menu " aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item custom-link" href="/favoris">Mes Favoris</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item custom-link" href="/profile/<?= Session::get(Session::USER)->id ?>">Mon profil</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>

        </li>
        <li><a class="dropdown-item custom-link" href="/mes_reservation/<?= Session::get(Session::USER)->id ?>">Mes réservation</a></li>
        <li>
          <hr class="dropdown-divider">
        </li>
        </li>
        <li><a class="dropdown-item custom-link" href="/logout">Me déconnecter</a></li>
      </ul>
  </div>



  <div class="dropdown custom-link p-4" id="nav2">
    <a class="dropdown-toggle button btn-secondary" href="" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
      Mon compte
      <i class="bi bi-person custom-svg"></i>
    </a>
    <ul class="dropdown-menu " aria-labelledby="dropdownMenuLink">
      <li><a class="dropdown-item custom-link" href="/add_logement">Ajouter un bien</a></li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li><a class="dropdown-item custom-link" href="/mesBiens/<?= Session::get(Session::USER)->id ?>">Mes annonces</a></li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li><a class="dropdown-item custom-link" href="/les-reservations/<?= Session::get(Session::USER)->id ?>">Les reservations</a></li>
      <li>
        <hr class="dropdown-divider">
      </li>

      <li><a class="dropdown-item custom-link" href="/logout">Me déconnecter</a></li>
    </ul>
  </div>


</div>



<?php else : ?>

  <a href="/connexion"> <button class="btn button ">Se connecter
      <i class="bi bi-person custom-svg"></i> </button>
  </a>

<?php endif ?>


<script>
  if (localStorage.getItem("buttonState") === "active") {
    // Si le bouton était actif, définissez l'état initial en conséquence
    switchBtn.classList.add("active");
    slider.classList.add("active");
    choice.classList.add("active");
    nav2.classList.add("active");
    nav1.classList.add("active");
    choice.textContent = "Loueur";
  } else {
    // Si le bouton n'était pas actif, définissez l'état initial en conséquence
    choice.textContent = "Voyageur";
  }

  // Ajoutez un écouteur d'événements au bouton de commutation
  switchBtn.addEventListener("click", () => {
    // Basculez l'état du bouton
    switchBtn.classList.toggle("active");
    slider.classList.toggle("active");
    choice.classList.toggle("active");
    nav2.classList.toggle("active");
    nav1.classList.toggle("active");

    // Mettez à jour le texte du choix en fonction de l'état du bouton
    choice.textContent = choice.classList.contains("active") ? "Loueur" : "Voyageur";

    // Stockez l'état du bouton dans le stockage local
    localStorage.setItem("buttonState", choice.classList.contains("active") ? "active" : "inactive");
  });
</script>