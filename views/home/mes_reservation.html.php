<h1 class="text-center p-3 m-5 title">Mes reservation</h1>

<?php if (empty($reservations)) : ?>
    <p class="text-center p-3 m-5">Aucune réservation faites.</p>
<?php else : ?>
    <div style="display: grid !important;grid-template-columns: repeat(4, 25%); gap:8px !important;" >
    <?php foreach ($reservations as $reservation) : ?>
        <div style="width: 80% !important;height: 100% !important; display:flex;justify-content:center;align-items:center; border-radius: 10px;border: 1px solid #ccc; " >
            <div style="display:flex; flex-direction: column; justify-content:space-evenly;align-items:center; padding:8px;">
                <h3>Mon sejour</h3>
                <p class="card-title">Date d'arrivée : <?= ($reservation->date_start) ?></p>
                <p class="card-text">Date de fin : <?= ($reservation->date_end) ?></p>
                <p class="card-text">Prix total : <b><?= ($reservation->price_total) ?>€</b></p>
                <a onclick="return confirm('Voulez-vous vraiment supprimer cette réservation ?')" href="/delete/reservation/<?= htmlspecialchars($reservation->id) ?>" class="btn btn-danger">
                    <i class="bi bi-trash"></i>
                </a>
            </div>
        </div> 
        <?php endforeach; ?>
   </div>
<?php endif; ?>