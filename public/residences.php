<?php
require_once '../src/db.php';

$residences = getResidences();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Residences</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Airbnb Clone</h1>
        <nav>
            <a href="index.php">Home</a> |
            <a href="residences.php">Residences</a> |
            <a href="users.php">Users</a>
        </nav>
    </header>
    <div class="container">
        <h2>Residences</h2>
        <?php foreach ($residences as $residence): ?>
            <div class="card">
                <img src="path/to/image.jpg" alt="Residence Image">
                <h2><?= htmlspecialchars($residence['title']) ?></h2>
                <p><?= htmlspecialchars($residence['description']) ?></p>
                <p class="price">$<?= htmlspecialchars($residence['price_per_night']) ?> per night</p>
                <a href="residence-details.php?id=<?= $residence['id'] ?>">View Details</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
