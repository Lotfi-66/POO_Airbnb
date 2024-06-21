<h1 class="text-center p-3 m-5 title">Mes Logements réservés</h1>

<?php if (!empty($logements)) : ?>
    <?php foreach ($logements as $logement) : ?>
        <?php if (!empty($logement->reservations)) : ?>
            <div class="card d-flex flex-row m-3 w-25">
                <div class="card-body">
                    <h3>Mon logement</h3>
                    <p class="card-title">Le logement : <?= ($logement->title) ?></p>

                    <?php foreach ($logement->reservations as $reservation) : ?>
                        <p class="card-title">Arrivée des locataires le : <?= ($reservation->date_start) ?></p>
                        <p class="card-title">Départ des locataires le : <?= ($reservation->date_end) ?></p>
                        <p class="card-title">Prix total : <?= ($reservation->price_total) ?>€</p>
                    <?php endforeach; ?>

                    <a onclick="return confirm('Voulez-vous vraiment supprimer cette réservation ?')" href="/delete/reservation/<?= htmlspecialchars($reservation->id) ?>" class="btn btn-danger">
                        <i class="bi bi-trash">Annuler la réservation</i>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else : ?>
    <p class="text-center p-3 m-5">Aucune réservation faite.</p>
<?php endif; ?>
