<h1 class="text-center">Mes Logement en location </h1>


<?php

use App\Model\Logement; ?>






<div class="d-flex flex-row flex-wrap p-3 gap-3 "> <?php foreach ($logements as $reservation) : ?>
        <div class="card">
            <div class="card-body  ">
                <h5 class="card-title">logement : <?= $reservation->title ?></h5>

                <p class="card-text">Prix par nuit: <b><?= $reservation->price_per_night ?>€</b></p>

                <a onclick="return confirm('Voulez vous vraiment supprimer votre logement')" href="/delete/<?= $reservation->id ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Suprimmer mon Logement</a>



            </div>
        </div>

    <?php endforeach ?>


</div>