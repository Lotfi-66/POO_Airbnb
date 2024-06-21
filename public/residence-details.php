<?php
require_once '../src/db.php';

$id = $_GET['id'];
$conn = connect();
$sql = "SELECT * FROM Residence WHERE id = $id";
$result = $conn->query($sql);
$residence = $result->fetch_assoc();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Residence Details</title>
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
        <h2><?= htmlspecialchars($residence['title']) ?></h2>
        <img src="path/to/image.jpg" alt="Residence Image">
        <p><?= htmlspecialchars($residence['description']) ?></p>
        <p>Size: <?= htmlspecialchars($residence['size']) ?> sq ft</p>
        <p>Rooms: <?= htmlspecialchars($residence['nb_rooms']) ?></p>
        <p>Beds: <?= htmlspecialchars($residence['nb_beds']) ?></p>
        <p>Baths: <?= htmlspecialchars($residence['nb_baths']) ?></p>
        <p>Travelers: <?= htmlspecialchars($residence['nb_travelers']) ?></p>
        <p class="price">$<?= htmlspecialchars($residence['price_per_night']) ?> per night</p>
        <button>Book Now</button>
    </div>
</body>
</html>
