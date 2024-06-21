<h1 class="text-center p-3 m-5 title">** Ajout d'un logement **</h1>

<?php

use App\AppRepoManager;
use Core\Session\Session; ?>


<!-- formulaire d'ajout d'un logement -->

<form action="/add_logement_form" method="POST" enctype="multipart/form-data">

  <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id ?>">

  <!-- Adresse du logement -->
  <div id="responsive-form" class="w-100 d-flex justify-content-center gap-5">
    <div>
      <h2 class="p-3">Adresse du logement </h2>
      <div class="card adress d-flex flex-row p-3 text-center gap-3 ">

        <div class="form-group">
          <label for="city">ville</label>
          <input type="text" class="form-control" id="city" aria-describedby="emailHelp" placeholder="Ville" name="city">

        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Pays</label>
          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Pays" name="country">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">code postal</label>
          <input type="number" class="form-control" id="exampleInputPassword1" placeholder="code postal" name="zip_code">
        </div>


      </div>

      <!-- Caracteristique du logement -->
      <h2 class="p-3">Caracteristique du logement </h2>
      <div class="card adress d-flex flex-row p-3 gap-3  text-center  justify-content-center ">



        <div class="form-group">
          <label for="nb_rooms">nombre de chambre</label>
          <input type="number" value="1" min="1" class="form-control" id="example
      nb_rooms" placeholder="Nombre de chambre" name="nb_rooms">
        </div>

        <div class="form-group">
          <label for="nb_bed">nombre de lit </label>
          <input type="number" value="1" min="1" class="form-control" id="nb_bed" placeholder="Nombre de lit" name="nb_bed">
        </div>

        <div class="form-group">
          <label for="nb_traveler">nombre de voyageur</label>
          <input type="number" value="1" min="1" class="form-control" id="nb_traveler" placeholder="Nombre de voyageur" name="nb_traveler">
        </div>
      </div>


      <!--Taille et prix -->

      <div class="card adress d-flex flex-row p-3 gap-3  ">

        <div class="form-group">
          <label for="size">Taille du logement</label>
          <input type="number" min="1" class="form-control" id="size" placeholder="Taille du logement " name="size">
        </div>

        <div class="form-group">
          <label for="price_per_night">Prix par nuit</label>
          <input type="number" class="form-control" id="price_per_night" placeholder="Prix par nuit" name="price_per_night">
        </div>

      </div>


  
      <!-- Type de logement et equipement -->

   

       
      <h2 class="p-3">Equipement a disposition</h2>
      <div class="card p-3 gap-3  ">

        <?php foreach (AppRepoManager::getRm()->getEquipementRepository()->getAllEquipement() as $equipement) :
        ?>
          

            <div class="form-check form-switch align-items-center ">
              <input name="equipements[]" value="<?= $equipement->id ?>" class="form-check-input " type="checkbox" role="switch">
              <label class="form-check-label footer-description  m-1"><?= $equipement->label ?></label>
            </div>
         
        <?php endforeach ?>
      </div>
    </div>
    <div>   
      <h2 class="p-3">Type de logement</h2>
      <div class="card adress d-flex flex-row  p-3 gap-3  ">

        <div class="form-check">
          <input class="form-check-input" type="radio" name="type" id="flexRadioDefault1" value="1">
          <label class="form-check-label" for="flexRadioDefault1">
            Appartement
          </label>
        </div>
        <div class="form-check ">
          <input class="form-check-input" type="radio" name="type" id="flexRadioDefault2" value="2">
          <label class="form-check-label" for="flexRadioDefault2">
            Maison
          </label>
        </div>
        <div class="form-check ">
          <input class="form-check-input" type="radio" name="type" id="flexRadioDefault3" value="3">
          <label class="form-check-label" for="flexRadioDefault3">
            Insolite
          </label>
        </div>


      </div>
      <!-- Photos et description -->
      <h2 class="p-3">Mettre votre annonce en avant</h2>
      <div class="card text-center d-flex flex-column p-3 gap-3 ">
        <div class="form-group">
          <label for="titre" class="p-1">Titre de l'annonce</label>
          <input type="text" class="form-control" id="titre" placeholder="titre" name="title">
        </div>



        <div class="form-group d-flex flex-column">
          <label for="description" class="p-1">Description du logement</label>
          <textarea name="description" row="4" cols="50" id="description"></textarea>
        </div>



        <div class="form-group d-flex flex-column">
          <h3>Limité a 3 photos </h3>
          <label class="p-2" for="img">Photos du logements</label>
          <input type="file" class="form-control" placeholder="image" name="img[]" multiple  >
  
        </div>

      </div>




      <!-- Formulaire de contact -->
      <h2 class="p-3">Vous contactez en cas de probleme</h2>
      <div class="card text-center d-flex flex-column p-3 gap-3 ">
        <div class="form-group ">
          <label for="phone">Téléphone</label>
          <input type="text" class="form-control" id="phone" placeholder="Téléphone" name="phone">
        </div>
          <button type="submit" class="btn button btn-primary w-100 p-3 mt-5">Mettre mon logement en location</button>
        </div>
    
    </div>
  </div>

</form>