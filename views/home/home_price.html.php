

<h1 class="text-center">Les locations disponibles</h1>

<nav class="navbar navbar-expand-lg bg-body-tertiary w-50 m-auto">
  <div class="container-fluid container-fluid  mb-5 mt-5 navBg">
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-danger" type="submit"><i class="bi bi-search"></i></button>
    </form>


    <div class="collapse navbar-collapse p-3" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Filtres
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/home_price">Prix</a></li>
            <li><a class="dropdown-item" href="/home_type">Type</a></li>
           
          
         
          </ul>
        </li>

      </ul>

    </div>
  </div>
</nav>
<div class="d-flex justify-content-center flex-wrap gap-3">
<?php foreach ($logements as $logement) : ?>

  <div class="card d-flex " style="width: 18rem;">
    <div class="card-body width-150">
      <?php
      if (!empty($logement->medias)) {
        // Get the first media
        $media = $logement->medias[0];
      ?>
        <img src="/assets/img/<?= $media ?>" class="card-img-top" alt="">
      <?php
      }
      ?>
      <h5 class="card-title"><?= $logement->title ?> <span class="text-primary" style="width: 5rem;"><a id="" href=""><i class="bi bi-heart m-1" ></a></i></span></h5>
      <p class="card-text"><?= $logement->description ?></p>
      <p class="card-text">Prix : <b><?= $logement->price_per_night ?>€</b></p>
      <p>type : <?= $logement->type->label ?></p>
      <a  href="/details<?= $logement->id ?>" class="btn btn-primary button p-1 rounded-3">Details</a>
    </div>
  </div><?php endforeach; ?>
  </div>

  <script>



  </script>