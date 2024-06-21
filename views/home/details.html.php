<?php if (!$auth::isAuth()) $auth::redirect('/connexion') ?>

<?php

use Core\Session\Session; ?>


<h1 class="text-center p-3 m-5"><?= $logements->title ?></h1>

<div class="card-body justify-content-evenly  d-flex">
    <div class="d-grid gap-3 d-md-flex justify-content-md-end ">

    <div id="carouselExampleDark" class="carousel slide overflow-hidden" style="width:800px;" data-bs-ride="carousel">
   
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <?php
        $first = true;
        foreach ($logements->medias as $media) :
        ?>
        
            <div class="carousel-item <?php if ($first) { echo 'active'; $first = false; } ?>" data-bs-interval="10000">
                <img src="/assets/img/<?= $media->image_path ?>" class="d-block img-fluid w-100 object-fit-contain" style="height: 500px" alt="...">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
            </a>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-danger" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-danger" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


    <div class="d-flex flex-column">
        
        <div class="card-body bg-light border rounded ">
            <h2 class="card-title">Description</h2>
        <p><?= $logements->description ?></p>

            <p>Prix par nuit: <b><span id="nightPrice"> <?= $logements->price_per_night ?></span>€ </b></p>

            <p>nombre de chambre : <b> <?= $logements->nb_rooms ?></b> </p>

            <p>nombre de lit : <b> <?= $logements->nb_bed ?></b></p>

            <p>nombre de voyageur : <b> <?= $logements->nb_traveler ?></b></p>

            <p>taille du Logement : <b> <?= $logements->taille ?>m2</b></p>
        </div>


        <h2>Book your holiday</h2>


        <form action="/" method="POST" onsubmit="copierSpanDansHidden()">
            <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id ?>">
            <input type="hidden" name="logement_id" value="<?= $logements->id ?>">

            <label for="start_date">Start</label>
            <input id="start_date" type="date" name="start" required />
            <label for="end_date">End</label>
            <input id="end_date" type="date" name="end" required />

            <h3>Total : <span id="total" name="price"></span> €</h3>
            <input type="hidden" id="champCache" name="price">

            <button class="button" type="submit">Reserver</button>

        </form>

    </div>


    </div>
   

</div>

<script>

// convert today date to input format

total.textContent =  nightPrice.textContent;

console.log(total.value);
const today = new Date().toISOString().split("T")[0];

start_date.value = today;
start_date.min = today;


let tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 1);

// convert to input format
let tomorrowFormat = tomorrow.toISOString().split("T")[0];
end_date.value = tomorrowFormat;
end_date.min = tomorrowFormat;

start_date.addEventListener("change", (e) => {
  let day = new Date(e.target.value);

  if (end_date.value < start_date.value) {
    day.setDate(day.getDate() + 1);
    end_date.value = day.toISOString().split("T")[0];
  }
});

end_date.addEventListener("change", (e) => {
  let day = new Date(e.target.value);

  if (end_date.value < start_date.value) {
    day.setDate(day.getDate() - 1);
    start_date.value = day.toISOString().split("T")[0];
  }
});


let bookingCalc = () => {
  let diffTime = Math.abs(
    new Date(end_date.value) - new Date(start_date.value)
  );
  let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
  

  total.textContent = diffDays * nightPrice.textContent;

  

};




start_date.addEventListener("change", bookingCalc);
end_date.addEventListener("change", bookingCalc);





function copierSpanDansHidden() {
  let spanValue = document.getElementById('total').innerText;
  document.getElementById('champCache').value = spanValue;
}






</script>